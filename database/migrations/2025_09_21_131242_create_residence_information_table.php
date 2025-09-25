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
        Schema::create('residence_information', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade');
            $table->foreignId('province_id')->constrained('provinces')->onDelete('cascade');
            $table->foreignId('municipality_id')->constrained('municipalities')->onDelete('cascade');
            $table->foreignId('sector_id')->nullable()->constrained('sectors')->onDelete('cascade');
            $table->string('residential_complex')->nullable()->comment('Complejo residencial');
            $table->string('building')->nullable()->comment('Edificio');
            $table->string('apartment')->nullable()->comment('Apartamento');
            $table->string('neighborhood')->nullable()->comment('Barrio');
            $table->string('street_and_number')->nullable()->comment('Calle y número');
            $table->string('coordinates')->nullable()->comment('Coordenadas');
            $table->text('arrival_reference')->nullable()->comment('Referencia de llegada');
            $table->boolean('is_certified')->default(false)->comment('Si certifica que la información proporcionada es veraz y correcta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residence_information');
    }
};
