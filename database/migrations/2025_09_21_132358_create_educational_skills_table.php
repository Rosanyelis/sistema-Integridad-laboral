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
        Schema::create('educational_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade');
            $table->string('career')->nullable()->comment('Carrera');
            $table->string('educational_center')->nullable()->comment('Centro educativo');
            $table->string('province')->nullable()->comment('Provincia');
            $table->year('year')->nullable()->comment('Año de graduación');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('educational_skills');
    }
};
