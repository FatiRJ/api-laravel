<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id('paciente_id');
            $table->string('nombre');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('pais'); 
            $table->string('telefono');
            $table->date('fecha_nacimiento');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
