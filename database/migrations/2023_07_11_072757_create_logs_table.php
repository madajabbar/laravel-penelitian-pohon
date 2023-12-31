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
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sensor_id');
            $table->integer('soil_moisture')->nullable();
            $table->integer('humidity')->nullable();
            $table->integer('temperature')->nullable();
            $table->enum('quarter',[1,2,3,4]);
            $table->datetime('time');
            $table->timestamps();

            $table->foreign('sensor_id')->references('id')->on('sensors')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs');
    }
};
