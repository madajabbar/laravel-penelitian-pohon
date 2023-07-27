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
        Schema::create('relays', function (Blueprint $table) {
            $table->id();
            $table->string('id_unique')->unique();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('node_id');
            $table->timestamps();

            $table->foreign('node_id')->references('id')->on('nodes')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relays');
    }
};
