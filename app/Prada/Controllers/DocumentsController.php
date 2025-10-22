<?php

namespace App\Prada\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

/**
 * Controlador de Documentos
 *
 * Responsável pela gestão completa de documentos do sistema, incluindo
 * listagem, criação, upload, download e manipulação de ficheiros.
 *
 * @author Augusto Kussema
 * @since 21/10/2025
 */
class DocumentsController extends Controller
{
    /**
     * Exibe a listagem de documentos
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Document::with(['uploader:id,nome', 'farmacia:id,nome'])
                        ->active()
                        ->notArchived()
                        ->orderBy('created_at', 'desc');

        // Filtros
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('type')) {
            $query->ofType($request->type);
        }

        if ($request->filled('access_level')) {
            $query->withAccessLevel($request->access_level);
        }

        if ($request->filled('department')) {
            $query->where('department', $request->department);
        }

        // Paginação
        $documents = $query->paginate(12)->withQueryString();

        // Estatísticas para os filtros
        $stats = [
            'total' => Document::active()->notArchived()->count(),
            'pdf' => Document::active()->notArchived()->where('file_extension', 'pdf')->count(),
            'xlsx' => Document::active()->notArchived()->whereIn('file_extension', ['xls', 'xlsx'])->count(),
            'docx' => Document::active()->notArchived()->whereIn('file_extension', ['doc', 'docx'])->count(),
            'pptx' => Document::active()->notArchived()->whereIn('file_extension', ['ppt', 'pptx'])->count(),
        ];

        // Se for requisição AJAX, retornar JSON
        if ($request->ajax()) {
            return response()->json([
                'documents' => $documents,
                'stats' => $stats
            ]);
        }

        return view('prepharma.documents.index', compact('documents', 'stats'));
    }

    /**
     * Exibe o formulário de criação de documentos
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('prepharma.documents.create');
    }

    /**
     * Armazena um novo documento
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            // Depuração temporária: se a req tiver debug_upload=1 retornamos diagnostics em JSON
            if ($request->get('debug_upload')) {
                $files = $request->allFiles();
                $filesSummary = [];
                foreach ($files as $key => $f) {
                    if ($f instanceof \Illuminate\Http\UploadedFile) {
                        $filesSummary[$key] = [
                            'clientName' => $f->getClientOriginalName(),
                            'size' => $f->getSize(),
                            'isValid' => $f->isValid(),
                            'realPath' => $f->getRealPath(),
                            'mime' => $f->getClientMimeType(),
                        ];
                    } else {
                        $filesSummary[$key] = 'not uploadedfile instance';
                    }
                }

                return response()->json([
                    'success' => true,
                    'debug' => true,
                    'files' => $filesSummary,
                    'php' => [
                        'upload_max_filesize' => ini_get('upload_max_filesize'),
                        'post_max_size' => ini_get('post_max_size'),
                        'memory_limit' => ini_get('memory_limit'),
                    ],
                ]);
            }
            // Verificar presença do ficheiro antes da validação (Validator::make pode não considerar files corretamente)
            if (!$request->hasFile('file')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ficheiro não enviado. Verifique se seleccionou um ficheiro antes de submeter.'
                ], 422);
            }

            // Validação manual para garantir resposta JSON (mesmo sem header Accept)
            $validator = Validator::make($request->all(), [
                // 5120 KB = 5 MB
                'file' => 'required|file|max:5120|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'document_type' => ['required', Rule::in(array_keys(Document::DOCUMENT_TYPES))],
                'category' => 'nullable|string|max:100',
                'tags' => 'nullable|string',
                'document_date' => 'required|date',
                'author' => 'nullable|string|max:255',
                'department' => ['nullable', Rule::in(array_keys(Document::DEPARTMENTS))],
                'notes' => 'nullable|string',
                'access_level' => ['required', Rule::in(array_keys(Document::ACCESS_LEVELS))],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Dados inválidos. Por favor verifique os campos. ',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $validated = $validator->validated();


            // Diagnostics: registar quais ficheiros chegaram no request
            try {
                Log::info('Request files keys', array_keys($request->allFiles()));
                $allFiles = $request->allFiles();
                if (isset($allFiles['file'])) {
                    $tmp = $allFiles['file'];
                    Log::info('UploadedFile diagnostics', [
                        'clientName' => method_exists($tmp, 'getClientOriginalName') ? $tmp->getClientOriginalName() : null,
                        'size' => method_exists($tmp, 'getSize') ? $tmp->getSize() : null,
                        'isValid' => method_exists($tmp, 'isValid') ? $tmp->isValid() : null,
                    ]);
                }
            } catch (\Throwable $t) {
                Log::warning('Erro ao registar diagnostics dos ficheiros: ' . $t->getMessage());
            }

            $file = $request->file('file');

            // Verificações adicionais de segurança/diagnóstico
            if (!$file || !method_exists($file, 'getRealPath')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ficheiro inválido recebido pelo servidor.'
                ], 422);
            }

            if (!$file->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Erro no upload: ficheiro não é válido.'
                ], 422);
            }

            // Nota: alguns handlers PHP usam streams temporários que não expõem getRealPath;
            // não falhar aqui — iremos confiar no ficheiro armazenado no disk 'public' após storeAs.
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $storedName = Str::uuid() . '.' . $extension;
            $filePath = 'documents/' . date('Y/m') . '/' . $storedName;

            // Fazer upload do ficheiro para o disk 'public'
            // Usamos o terceiro parâmetro 'public' para garantir que vai para storage/app/public
            $realPath = $file->getRealPath();
            Log::info('Upload diagnostics', [
                'originalName' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'isValid' => $file->isValid(),
                'realPath' => $realPath,
                'php_upload_max_filesize' => ini_get('upload_max_filesize'),
                'php_post_max_size' => ini_get('post_max_size'),
            ]);

            $storedFullPath = null;
            try {
                // Garantir diretório existe em storage/app/public
                $destinationDir = storage_path('app/public/' . dirname($filePath));
                if (!is_dir($destinationDir)) {
                    mkdir($destinationDir, 0755, true);
                }

                // Mover ficheiro para o destino (usa move_uploaded_file internamente)
                $moved = $file->move($destinationDir, $storedName);
                if ($moved === false) {
                    throw new \RuntimeException('Não foi possível mover o ficheiro para o destino.');
                }

                $storedFullPath = $destinationDir . DIRECTORY_SEPARATOR . $storedName;
            } catch (\Throwable $e) {
                Log::error('Erro ao armazenar ficheiro (move)', [
                    'message' => $e->getMessage(),
                    'originalName' => $file->getClientOriginalName(),
                    'realPath' => $realPath,
                    'filePath' => $filePath,
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'Erro ao armazenar ficheiro: ' . $e->getMessage(),
                ], 500);
            }

            // Processar tags
            $tags = null;
            if ($validated['tags']) {
                $tags = array_map('trim', explode(',', $validated['tags']));
                $tags = array_filter($tags);
            }

            // Obter metadados a partir do ficheiro armazenado (mais robusto que confiar em getRealPath)
            $mimeType = null;
            $fileSize = null;
            $hash = null;

            if (file_exists($storedFullPath)) {
                $mimeType = mime_content_type($storedFullPath) ?: $file->getMimeType();
                $fileSize = filesize($storedFullPath) ?: $file->getSize();
                $hash = hash_file('sha256', $storedFullPath);
            } else {
                // Fallback para os métodos do UploadedFile quando o ficheiro não for encontrado no disk (raro)
                $mimeType = $file->getMimeType();
                $fileSize = $file->getSize();
                try {
                    $realPath = $file->getRealPath();
                    $hash = $realPath ? hash_file('sha256', $realPath) : null;
                } catch (\Throwable $t) {
                    $hash = null;
                }
            }

            // Criar registo do documento
            $document = Document::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'original_filename' => $originalName,
                'stored_filename' => $storedName,
                'file_path' => $filePath,
                'mime_type' => $mimeType,
                'file_extension' => strtolower($extension),
                'file_size' => $fileSize,
                'hash' => $hash,
                'document_type' => $validated['document_type'],
                'category' => $validated['category'],
                'tags' => $tags,
                'document_date' => $validated['document_date'],
                'author' => $validated['author'],
                'department' => $validated['department'],
                'notes' => $validated['notes'],
                'access_level' => $validated['access_level'],
                'uploaded_by' => Auth::id(),
                'farmacia_id' => Auth::user()->farmacia_id ?? null,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Documento carregado com sucesso!',
                'document' => $document->load('uploader:id,nome')
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao carregar documento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Exibe um documento específico
     *
     * @param Document $document
     * @return \Illuminate\View\View
     */
    public function show(Document $document)
    {
        $document->incrementViewCount();

        return view('prepharma.documents.show', compact('document'));
    }

    /**
     * Download de um documento
     *
     * @param Document $document
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function download(Document $document)
    {
        if (!$document->fileExists()) {
            abort(404, 'Ficheiro não encontrado.');
        }

        $document->incrementDownloadCount();

        return Storage::disk('public')->download(
            $document->file_path,
            $document->original_filename
        );
    }

    /**
     * Preview de um documento
     *
     * @param Document $document
     * @return JsonResponse
     */
    public function preview(Document $document): JsonResponse
    {
        $document->incrementViewCount();

        return response()->json([
            'id' => $document->id,
            'name' => $document->name,
            'description' => $document->description,
            'file_extension' => $document->file_extension,
            'file_size' => $document->formatted_file_size,
            'document_type' => $document->document_type_name,
            'author' => $document->author,
            'document_date' => $document->document_date->format('d/m/Y'),
            'icon_class' => $document->icon_class,
            'download_url' => $document->download_url,
            'can_preview' => in_array($document->file_extension, ['pdf', 'txt']),
        ]);
    }

    /**
     * Elimina um documento
     *
     * @param Document $document
     * @return JsonResponse
     */
    public function destroy(Document $document): JsonResponse
    {
        try {
            $document->update(['updated_by' => Auth::id()]);
            $document->delete();

            return response()->json([
                'success' => true,
                'message' => 'Documento eliminado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao eliminar documento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Restaura um documento eliminado
     *
     * @param string $id
     * @return JsonResponse
     */
    public function restore(string $id): JsonResponse
    {
        try {
            $document = Document::withTrashed()->findOrFail($id);
            $document->restore();

            return response()->json([
                'success' => true,
                'message' => 'Documento restaurado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao restaurar documento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Arquiva um documento
     *
     * @param Document $document
     * @return JsonResponse
     */
    public function archive(Document $document): JsonResponse
    {
        try {
            $document->update([
                'is_archived' => true,
                'updated_by' => Auth::id()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Documento arquivado com sucesso!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao arquivar documento: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Obtém estatísticas dos documentos
     *
     * @return JsonResponse
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total' => Document::active()->notArchived()->count(),
            'by_type' => Document::active()->notArchived()
                        ->selectRaw('document_type, COUNT(*) as count')
                        ->groupBy('document_type')
                        ->pluck('count', 'document_type'),
            'by_extension' => Document::active()->notArchived()
                            ->selectRaw('file_extension, COUNT(*) as count')
                            ->groupBy('file_extension')
                            ->pluck('count', 'file_extension'),
            'recent' => Document::active()->notArchived()
                       ->orderBy('created_at', 'desc')
                       ->limit(5)
                       ->get(['id', 'name', 'document_type', 'created_at']),
        ];

        return response()->json($stats);
    }
}
