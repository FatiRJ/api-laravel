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
        Schema::create('hospitales_medicos', function (Blueprint $table) {
            $table->unsignedBigInteger('hospital_id');
            $table->unsignedBigInteger('medico_id');
            $table->foreign('hospital_id')->references('hospital_id')->on('hospitales')->onDelete('cascade');
            $table->foreign('medico_id')->references('medico_id')->on('medicos')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospitales_medicos');
    }
};
