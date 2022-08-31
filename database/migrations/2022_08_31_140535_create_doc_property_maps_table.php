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
        Schema::create('doc_property_maps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('doc_type_id')->references('id')->on('doc_types');
            $table->unsignedBigInteger('property_type_id')->references('id')->on('property_types');
            $table->timestamps();
            $table->softDeletes();
            $table->comment('Data model definitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doc_property_maps');
    }
};
