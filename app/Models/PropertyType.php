<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Model for property definitions
 */
class PropertyType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'property_name',
        'property_description',
        'data_type',
    ];
    protected $table = 'property_types';
}
