<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('medicos', function (Blueprint $table) {
            $table->id('medico_id');
            $table->string('nombre');
            $table->string('especialidad');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('medicos');
    }
};
