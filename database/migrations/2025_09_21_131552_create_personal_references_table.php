<?php

use App\Enums\Relationship;
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
        Schema::create('personal_references', function (Blueprint $table) {
            $table->id();
            $table->foreignId('person_id')->constrained('people')->onDelete('cascade');
            $table->enum('relationship', array_column(Relationship::cases(), 'value'))->nullable()->comment('Afinidad');
            $table->string('full_name')->nullable()->comment('Nombre(s) y Apellidos');
            $table->string('cedula')->nullable()->comment('Cédula');
            $table->string('cell_phone')->nullable()->comment('Teléfono celular');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_references');
    }
};
