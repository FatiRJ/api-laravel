<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id('departamento_id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
