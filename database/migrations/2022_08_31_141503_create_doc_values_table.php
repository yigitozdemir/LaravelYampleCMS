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
        Schema::create('doc_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('document_id')->references('id')->on('documents');
            $table->unsignedBigInteger('property_type_id')->reference('id')->on('property_types');
            $table->string('property_value');
            $table->timestamps();
            $table->softDeletes();
            $table->comment('This table contains document and property mappings (value based)');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_values');
    }
};
