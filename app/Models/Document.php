<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Base metadata for a document
 */
class Document extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'documents';
    protected $fillable = 
    [
        'doc_name',
        'document_type',
        'doc_description',
        'physical_document'
    ];

    public function docValues()
    {
        return $this->hasMany(DocValues::class);
    }

    /**
     * returns true if any document has been created in given $documentTypeId
     * @param mixed $documentTypeId
     * 
     * @return bool documentType is in use
     */
    public static function usingDocumentType($documentTypeId)
    {
        return (Document::where('document_type', '=', $documentTypeId)->count() > 0);
    }
}
