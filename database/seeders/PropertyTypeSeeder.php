<?php

namespace Database\Seeders;

use App\Models\PropertyType;
//use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyType::create([
            'property_name' => 'Identifier Property',
            'property_description' => 'Property description 1',
            'data_type' => 'INT',
        ]);

        PropertyType::create([
            'property_name' => 'Description',
            'property_description' => 'Property description 2',
            'data_type' => 'TEXT',
        ]);

        PropertyType::create([
            'property_name' => 'Correctness',
            'property_description' => 'Property description 3',
            'data_type' => 'FLOAT',
        ]);

        PropertyType::create([
            'property_name' => 'Other INT Field',
            'property_description' => 'Property description 4',
            'data_type' => 'INT',
        ]);

        PropertyType::create([
            'property_name' => 'Where Customer Is Located',
            'property_description' => 'Property description 5',
            'data_type' => 'TEXT',
        ]);
    }
}
