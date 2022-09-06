<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_name');
            $table->string('doc_description')->nullable();
            $table->unsignedBigInteger('document_type')->reference('id')->on('doc_types');
            $table->string('physical_document')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->comment('core table to list documents');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
