<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos basados en los módulos existentes del sistema
        $permissions = [
            // Dashboard
            'view-dashboard',
            
            // Módulo de Usuarios
            'read_usuarios',
            'create_usuarios',
            'view_usuarios',
            'edit_usuarios',
            'delete_usuarios',
            
            // Módulo de Roles
            'read_roles',
            'create_roles',
            'view_roles',
            'edit_roles',
            'delete_roles',
            
            // Perfil
            'view-profile',
            'edit-profile',
        ];

        // Crear permisos
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Crear roles
        $superAdminRole = Role::firstOrCreate(['name' => 'Super Admin', 'guard_name' => 'web']);
        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $userEmpresaRole = Role::firstOrCreate(['name' => 'Empresa', 'guard_name' => 'web']);
        $userReclutadorRole = Role::firstOrCreate(['name' => 'Reclutador', 'guard_name' => 'web']);
        $userPublicoRole = Role::firstOrCreate(['name' => 'Público', 'guard_name' => 'web']);


        // Asignar TODOS los permisos al Super Admin
        $superAdminRole->givePermissionTo(Permission::all());

        // Asignar permisos al Administrador (todos los permisos de usuarios y roles)
        $adminPermissions = [
            'view-dashboard',
            'read_usuarios', 'create_usuarios', 'view_usuarios', 'edit_usuarios', 'delete_usuarios',
            'read_roles', 'create_roles', 'view_roles', 'edit_roles', 'delete_roles',
            'view-profile', 'edit-profile',
        ];
        $adminRole->givePermissionTo($adminPermissions);

        // Asignar permisos básicos al Usuario (solo lectura de usuarios y perfil)
        $userPermissions = [
            'view-dashboard',
            'read_usuarios', 'view_usuarios',
            'view-profile', 'edit-profile',
        ];
        $userEmpresaRole->givePermissionTo($userPermissions);
        $userReclutadorRole->givePermissionTo($userPermissions);
        $userPublicoRole->givePermissionTo($userPermissions);

        // Crear usuarios de ejemplo para cada rol
        $this->createUsers();
    }

    private function createUsers()
    {
        // Super Admin
        $superAdmin = User::firstOrCreate(
            ['email' => 'superadmin@integridad-laboral.com'],
            [
                'name' => 'Super Administrador',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdmin->assignRole('Super Admin');

        // Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@integridad-laboral.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole('Administrador');

        // Usuario Reclutador
        $userReclutador = User::firstOrCreate(
            ['email' => 'reclutador@integridad-laboral.com'],
            [
                'name' => 'Reclutador Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $userReclutador->assignRole('Reclutador');

        $userEmpresa = User::firstOrCreate(
            ['email' => 'empresa@integridad-laboral.com'],
            [
                'name' => 'Empresa Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $userEmpresa->assignRole('Empresa');

        // Usuario Público
        $userPublico = User::firstOrCreate(
            ['email' => 'publico@integridad-laboral.com'],
            [
                'name' => 'Público Demo',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $userPublico->assignRole('Público');
        
    }
}