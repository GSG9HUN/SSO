<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnimalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('species_id')->references('id')->on('species');
            $table->foreignId('sex_id')->references('id')->on('sex');
            $table->foreignId('size_id')->references('id')->on('size');
            $table->foreignId('color_id')->references('id')->on('color');
            $table->integer('age');
            $table->text('description')->nullable();
            $table->boolean('mix')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('animal');
    }
}
