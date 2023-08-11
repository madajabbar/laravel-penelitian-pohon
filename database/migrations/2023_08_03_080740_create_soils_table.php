<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('soils', function (Blueprint $table) {
            $table->id();
            $table->string('id_unique');
            $table->integer('value');
            $table->unsignedBigInteger('sensor_id');
            $table->timestamps();

            $table->foreign('sensor_id')->references('id')->on('sensors')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soils');
    }
};
