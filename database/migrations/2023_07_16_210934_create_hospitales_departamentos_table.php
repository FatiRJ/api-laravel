<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hospitales_departamentos', function (Blueprint $table) {
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('departamento_id');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospitales')->onDelete('cascade');
            $table->foreign('departamento_id')->references('departamento_id')->on('departamentos')->onDelete('cascade');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('hospitales_departamentos');
    }
};
