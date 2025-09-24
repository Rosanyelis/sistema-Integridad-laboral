<?php

use App\Enums\MaritalStatus;
use App\Enums\EmploymentStatus;
use App\Enums\VerificationStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('code_unique')->unique()->comment('Código único para la persona entre numero consecutivo y fecha 01-08092025');
            $table->string('profile_photo')->nullable()->comment('Foto de perfil');
            $table->string('name')->comment('Nombres');
            $table->string('last_name')->comment('Apellidos');
            $table->string('dni')->unique()->comment('Cedula');
            $table->string('previous_dni')->nullable()->comment('Cedula anterior');
            $table->string('country')->comment('País');
            $table->string('zip_code')->nullable()->comment('Código postal');
            $table->string('birth_place')->comment('Lugar de nacimiento');
            $table->string('cell_phone')->nullable()->comment('Teléfono celular');
            $table->string('home_phone')->nullable()->comment('Teléfono fijo');
            $table->string('email')->nullable()->comment('Email');
            $table->date('birth_date')->comment('Fecha de nacimiento');
            $table->integer('age')->nullable()->comment('Edad');
            $table->enum('marital_status', array_column(MaritalStatus::cases(), 'value'))->nullable()->comment('Estado Civil'); 
            $table->string('social_media_1')->nullable()->comment('Red social 1');
            $table->string('social_media_2')->nullable()->comment('Red social 2');
            $table->string('blood_type')->nullable()->comment('Tipo de sangre');
            $table->text('medication_allergies')->nullable()->comment('Medicamentos y alergias');
            $table->text('illnesses')->nullable()->comment('Enfermedades');
            $table->string('emergency_contact_name')->nullable()->comment('Nombre de contacto de emergencia');
            $table->string('emergency_contact_phone')->nullable()->comment('Teléfono de contacto de emergencia');
            $table->string('other_emergency_contacts')->nullable()->comment('Otros contactos de emergencia');
            $table->string('position_applied_for')->nullable()->comment('Posición aplicada para');
            $table->string('company_code')->nullable()->comment('Código de la empresa');
            $table->string('company_name')->nullable()->comment('Nombre de la empresa');
            $table->enum('verification_status', array_column(VerificationStatus::cases(), 'value'))->default(VerificationStatus::PENDIENTE->value)->nullable()->comment('Estado de verificación');
            $table->enum('employment_status', array_column(EmploymentStatus::cases(), 'value'))->default(EmploymentStatus::PENDIENTE->value)->nullable()->comment('Estado de empleo');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
