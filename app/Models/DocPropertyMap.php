<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Maps a document type with properties
 */
class DocPropertyMap extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'doc_property_maps';
    protected $fillable = [
        'doc_type_id',
        'property_type_id'
    ];

    public function getProperties(){
        $this->hasMany(PropertyType::class);
    }

    public function getProperty(){
        return PropertyType::findOne($this->propery_type_id);
    }

    public function getPropertyName(){
        return $this->getProperty()->property_name;
    }
}
