<?php

namespace Database\Seeders;

use App\Models\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Document::create([
            'doc_name' => 'A document uploaded for test',
            'doc_description' => 'Description: This document has been uploaded for test',
            'document_type' => 1,
            'physical_document' => 'capture.png',
        ]);
    }
}
