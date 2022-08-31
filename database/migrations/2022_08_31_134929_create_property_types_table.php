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
        Schema::create('property_types', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('property_name')->unique();
            $table->string('property_description');
            $table->enum('data_type', ['INT', 'DATE', 'FLOAT', 'TEXT']);
            $table->timestamps();
            $table->softDeletes();
            $table->comment('Table to store property definitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_types');
    }
};
