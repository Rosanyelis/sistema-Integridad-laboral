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
        Schema::create('work_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade');
            $table->string('company_name')->nullable()->comment('Nombre de la empresa');
            $table->string('position')->nullable()->comment('Posición');
            $table->date('from_date')->nullable()->comment('Fecha de inicio');
            $table->date('to_date')->nullable()->comment('Fecha de fin');
            $table->text('responsibilities')->nullable()->comment('Responsabilidades');
            $table->text('achievements')->nullable()->comment('Logros');
            $table->text('skills')->nullable()->comment('Habilidades');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_experiences');
    }
};
