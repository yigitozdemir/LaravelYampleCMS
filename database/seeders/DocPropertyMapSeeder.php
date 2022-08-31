<?php

namespace Database\Seeders;

use App\Models\DocPropertyMap;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocPropertyMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocPropertyMap::create([
            'doc_type_id' => 1,
            'property_type_id' => 1,
        ]);

        DocPropertyMap::create([
            'doc_type_id' => 1,
            'property_type_id' => 2,
        ]);

        DocPropertyMap::create([
            'doc_type_id' => 1,
            'property_type_id' => 3,
        ]);

        DocPropertyMap::create([
            'doc_type_id' => 1,
            'property_type_id' => 4,
        ]);

        DocPropertyMap::create([
            'doc_type_id' => 1,
            'property_type_id' => 5,
        ]);
    }
}
