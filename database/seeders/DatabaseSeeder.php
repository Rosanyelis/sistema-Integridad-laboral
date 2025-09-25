<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar el seeder de roles y permisos
        $this->call([
            RolePermissionSeeder::class,
            ProvinceSeeder::class,
            MunicipaltySeeder::class,
            SectorSeeder::class,
        ]);

        // Crear usuarios adicionales con factory (opcional)
        // User::factory(10)->create();
    }
}
