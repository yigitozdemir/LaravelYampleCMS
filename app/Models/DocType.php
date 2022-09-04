<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Very Simple Document Type model
 */
class DocType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'doc_types';
    protected $primary_key = 'id';
    protected $fillable = [
        'doc_type_name',
        'doc_type_description',
    ];

    public static function exists($docTypeId)
    {
        return (DocType::find($docTypeId) != null);
    }
}
