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
        $query = Document::with(['uploader:id,name', 'farmacia:id,nome'])
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
            $validated = $request->validate([
                'file' => 'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx',
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

            $file = $request->file('file');
            $originalName = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $storedName = Str::uuid() . '.' . $extension;
            $filePath = 'documents/' . date('Y/m') . '/' . $storedName;

            // Fazer upload do ficheiro
            $file->storeAs('public/' . dirname($filePath), basename($filePath));

            // Processar tags
            $tags = null;
            if ($validated['tags']) {
                $tags = array_map('trim', explode(',', $validated['tags']));
                $tags = array_filter($tags);
            }

            // Criar registo do documento
            $document = Document::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'original_filename' => $originalName,
                'stored_filename' => $storedName,
                'file_path' => $filePath,
                'mime_type' => $file->getMimeType(),
                'file_extension' => strtolower($extension),
                'file_size' => $file->getSize(),
                'hash' => hash_file('sha256', $file->getRealPath()),
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
                'document' => $document->load('uploader:id,name')
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
