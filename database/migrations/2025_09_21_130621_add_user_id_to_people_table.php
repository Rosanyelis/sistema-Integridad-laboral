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
        Schema::table('people', function (Blueprint $table) {
            // Agregar columna user_id nullable
            $table->unsignedBigInteger('user_id')->nullable()->after('id')->comment('ID del usuario asociado a esta persona');
            
            // Agregar foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            
            // Agregar índice para mejorar performance
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('people', function (Blueprint $table) {
            // Eliminar foreign key constraint
            $table->dropForeign(['user_id']);
            
            // Eliminar índice
            $table->dropIndex(['user_id']);
            
            // Eliminar columna user_id
            $table->dropColumn('user_id');
        });
    }
};
