<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

/**
 * Model Document
 * 
 * Representa um documento no sistema farmacêutico com controlo completo
 * de metadados, acesso, versionamento e auditoria.
 * 
 * @author Augusto Kussema
 * @since 21/10/2025
 * 
 * @property string $id
 * @property string $name
 * @property string|null $description
 * @property string $original_filename
 * @property string $stored_filename
 * @property string $file_path
 * @property string $mime_type
 * @property string $file_extension
 * @property int $file_size
 * @property string $hash
 * @property string $document_type
 * @property string|null $category
 * @property array|null $tags
 * @property Carbon $document_date
 * @property string|null $author
 * @property string|null $department
 * @property string $version
 * @property string|null $notes
 * @property string $access_level
 * @property bool $is_active
 * @property bool $is_archived
 * @property Carbon|null $expires_at
 * @property int $download_count
 * @property int $view_count
 * @property Carbon|null $last_accessed_at
 * @property string $uploaded_by
 * @property string|null $farmacia_id
 * @property string|null $updated_by
 */
class Document extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    /**
     * Nome da tabela
     */
    protected $table = 'documents';

    /**
     * Campos que podem ser preenchidos em massa
     */
    protected $fillable = [
        'name',
        'description',
        'original_filename',
        'stored_filename',
        'file_path',
        'mime_type',
        'file_extension',
        'file_size',
        'hash',
        'document_type',
        'category',
        'tags',
        'document_date',
        'author',
        'department',
        'version',
        'notes',
        'access_level',
        'is_active',
        'is_archived',
        'expires_at',
        'uploaded_by',
        'farmacia_id',
        'updated_by'
    ];

    /**
     * Campos que devem ser convertidos para tipos nativos
     */
    protected $casts = [
        'tags' => 'array',
        'document_date' => 'date',
        'expires_at' => 'datetime',
        'last_accessed_at' => 'datetime',
        'is_active' => 'boolean',
        'is_archived' => 'boolean',
        'file_size' => 'integer',
        'download_count' => 'integer',
        'view_count' => 'integer',
    ];

    /**
     * Campos que devem ser ocultados na serialização
     */
    protected $hidden = [
        'hash',
        'file_path',
        'stored_filename'
    ];

    /**
     * Tipos de documento disponíveis
     */
    public const DOCUMENT_TYPES = [
        'manual' => 'Manual de Procedimentos',
        'politica' => 'Política',
        'relatorio' => 'Relatório',
        'lista' => 'Lista de Preços',
        'inventario' => 'Inventário',
        'apresentacao' => 'Apresentação',
        'contrato' => 'Contrato',
        'procedimento' => 'Procedimento',
        'norma' => 'Norma',
        'certificado' => 'Certificado',
        'factura' => 'Factura',
        'outro' => 'Outro'
    ];

    /**
     * Níveis de acesso disponíveis
     */
    public const ACCESS_LEVELS = [
        'publico' => 'Público',
        'restrito' => 'Restrito',
        'confidencial' => 'Confidencial'
    ];

    /**
     * Departamentos disponíveis
     */
    public const DEPARTMENTS = [
        'farmacia' => 'Farmácia',
        'administracao' => 'Administração',
        'financeiro' => 'Financeiro',
        'recursos_humanos' => 'Recursos Humanos',
        'ti' => 'Tecnologia da Informação',
        'qualidade' => 'Qualidade',
        'compras' => 'Compras',
        'vendas' => 'Vendas',
        'outro' => 'Outro'
    ];

    /**
     * Relacionamento com o utilizador que fez upload
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Relacionamento com o último utilizador que atualizou
     */
    public function lastUpdater(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Relacionamento com a farmácia (se aplicável)
     */
    public function farmacia(): BelongsTo
    {
        return $this->belongsTo(Farmacia::class, 'farmacia_id');
    }

    /**
     * Scope para documentos ativos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para documentos não arquivados
     */
    public function scopeNotArchived($query)
    {
        return $query->where('is_archived', false);
    }

    /**
     * Scope para documentos por tipo
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('document_type', $type);
    }

    /**
     * Scope para documentos por nível de acesso
     */
    public function scopeWithAccessLevel($query, string $level)
    {
        return $query->where('access_level', $level);
    }

    /**
     * Scope para pesquisa de texto
     */
    public function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('author', 'like', "%{$search}%")
              ->orWhere('original_filename', 'like', "%{$search}%")
              ->orWhereJsonContains('tags', $search);
        });
    }

    /**
     * Accessor para obter o tamanho do ficheiro formatado
     */
    public function getFormattedFileSizeAttribute(): string
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Accessor para obter o tipo de documento traduzido
     */
    public function getDocumentTypeNameAttribute(): string
    {
        return self::DOCUMENT_TYPES[$this->document_type] ?? 'Desconhecido';
    }

    /**
     * Accessor para obter o nível de acesso traduzido
     */
    public function getAccessLevelNameAttribute(): string
    {
        return self::ACCESS_LEVELS[$this->access_level] ?? 'Desconhecido';
    }

    /**
     * Accessor para obter o departamento traduzido
     */
    public function getDepartmentNameAttribute(): ?string
    {
        return $this->department ? (self::DEPARTMENTS[$this->department] ?? $this->department) : null;
    }

    /**
     * Accessor para verificar se o documento expirou
     */
    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /**
     * Accessor para obter o URL de download
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('documents.download', $this->id);
    }

    /**
     * Accessor para obter o URL de preview
     */
    public function getPreviewUrlAttribute(): string
    {
        return route('documents.preview', $this->id);
    }

    /**
     * Accessor para obter o ícone baseado na extensão
     */
    public function getIconClassAttribute(): string
    {
        $iconMap = [
            'pdf' => 'fa-file-pdf',
            'doc' => 'fa-file-word',
            'docx' => 'fa-file-word',
            'xls' => 'fa-file-excel',
            'xlsx' => 'fa-file-excel',
            'ppt' => 'fa-file-powerpoint',
            'pptx' => 'fa-file-powerpoint',
            'txt' => 'fa-file-alt',
            'zip' => 'fa-file-archive',
            'rar' => 'fa-file-archive',
        ];

        return 'fa ' . ($iconMap[$this->file_extension] ?? 'fa-file');
    }

    /**
     * Incrementa o contador de downloads
     */
    public function incrementDownloadCount(): void
    {
        $this->increment('download_count');
        $this->update(['last_accessed_at' => now()]);
    }

    /**
     * Incrementa o contador de visualizações
     */
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
        $this->update(['last_accessed_at' => now()]);
    }

    /**
     * Verifica se o ficheiro existe no armazenamento
     */
    public function fileExists(): bool
    {
        return Storage::disk('public')->exists($this->file_path);
    }

    /**
     * Obtém o conteúdo do ficheiro
     */
    public function getFileContent(): ?string
    {
        if (!$this->fileExists()) {
            return null;
        }

        return Storage::disk('public')->get($this->file_path);
    }

    /**
     * Elimina o ficheiro do armazenamento
     */
    public function deleteFile(): bool
    {
        if ($this->fileExists()) {
            return Storage::disk('public')->delete($this->file_path);
        }

        return true;
    }

    /**
     * Boot do modelo para definir eventos
     */
    protected static function boot()
    {
        parent::boot();

        // Eliminar ficheiro quando o registo é eliminado permanentemente
        static::forceDeleted(function ($document) {
            $document->deleteFile();
        });
    }
}