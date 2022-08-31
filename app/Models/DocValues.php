<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Maps a document - property id and property value
 * Some properties on some documents might be null
 */
class DocValues extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'doc_values';
    protected $fillable = [
        'document_id',
        'property_type_id',
        'property_value'
    ];

    public function document()
    {
        return $this->hasOne(Document::class);
    }

    public function property()
    {
        return $this->hasOne(PropertyType::class);
    }
}
