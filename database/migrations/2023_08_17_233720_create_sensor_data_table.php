<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->integer('feed_id');
            $table->string('name');
            $table->string('description')->nullable();
            // Agrega más columnas aquí según la estructura de los datos
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
