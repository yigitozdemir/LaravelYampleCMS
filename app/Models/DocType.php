<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Document type model
 * More or less a simple Document Type class
 */
class DocType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [];

}
