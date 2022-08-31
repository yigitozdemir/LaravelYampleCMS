<?php

namespace Database\Seeders;

use App\Models\DocType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DocType::create([
            'doc_type_name' => 'Customer Document',
            'doc_type_description' => 'A document type handles customer based documents',
        ]);
    }
}
