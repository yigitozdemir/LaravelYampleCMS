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
        'doc_description',
        'physical_document'
    ];

    public function docValues()
    {
        return $this->hasMany(DocValues::class);
    }
}
