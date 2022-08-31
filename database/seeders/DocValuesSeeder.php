<?php

namespace Database\Seeders;

use App\Models\DocValues;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocValues::create([
            'document_id' => 1,
            'property_type_id' => 1,
            'property_value' => "12",
        ]);

        DocValues::create([
            'document_id' => 1,
            'property_type_id' => 2,
            'property_value' => "This is a text property",
        ]);

        DocValues::create([
            'document_id' => 1,
            'property_type_id' => 3,
            'property_value' => "12.32",
        ]);

        DocValues::create([
            'document_id' => 1,
            'property_type_id' => 4,
            'property_value' => "22",
        ]);

        DocValues::create([
            'document_id' => 1,
            'property_type_id' => 5,
            'property_value' => "Istanbul/Turkey",
        ]);
    }
}
