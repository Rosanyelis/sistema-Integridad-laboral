<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Estadísticas para las tarjetas
            $stats = [
                'total_roles' => Role::count(),
                'total_permissions' => Permission::count(),
                'assigned_users' => 0, // Temporalmente deshabilitado
            ];

            // Obtener roles con sus relaciones
            $roles = Role::with(['permissions'])
                ->orderBy('created_at', 'desc')
                ->get();

            return view('module.roles.index', compact('roles', 'stats'));
        } catch (\Exception $e) {
            Log::error('Error en RoleController@index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al cargar los roles: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener permisos reales de la base de datos
        $permissions = Permission::orderBy('name')->get();
        
        // Organizar permisos por módulos
        $modules = [
            [
                'key' => 'usuarios',
                'name' => 'USUARIOS',
                'description' => 'Gestión de usuarios del sistema',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'usuarios');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ],
            [
                'key' => 'roles',
                'name' => 'ROLES',
                'description' => 'Gestión de roles y permisos',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'roles');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ],
            [
                'key' => 'dashboard',
                'name' => 'DASHBOARD',
                'description' => 'Acceso al panel principal',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'dashboard');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ],
            [
                'key' => 'profile',
                'name' => 'PERFIL',
                'description' => 'Gestión del perfil de usuario',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'profile');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ]
        ];

        return view('module.roles.permissions', compact('modules'));
    }
    
    /**
     * Obtiene el nombre de visualización para un permiso
     */
    private function getPermissionDisplayName($permissionName)
    {
        $displayNames = [
            'read_usuarios' => 'Listar',
            'create_usuarios' => 'Crear',
            'view_usuarios' => 'Ver',
            'edit_usuarios' => 'Editar',
            'delete_usuarios' => 'Eliminar',
            'read_roles' => 'Listar',
            'create_roles' => 'Crear',
            'view_roles' => 'Ver',
            'edit_roles' => 'Editar',
            'delete_roles' => 'Eliminar',
            'view-dashboard' => 'Ver Dashboard',
            'view-profile' => 'Ver Perfil',
            'edit-profile' => 'Editar Perfil',
        ];
        
        return $displayNames[$permissionName] ?? ucfirst(str_replace(['_', '-'], ' ', $permissionName));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Log de los datos recibidos para debug
            Log::info('Creating role with data:', [
                'name' => $request->name,
                'permissions' => $request->permissions,
                'permissions_count' => is_array($request->permissions) ? count($request->permissions) : 0
            ]);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:roles,name',
                'description' => 'nullable|string|max:500',
                'permissions' => 'required|array|min:1',
                'permissions.*' => 'required|integer|exists:permissions,id'
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed for role creation:', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $role = Role::create([
                'name' => $request->name,
                'guard_name' => 'web'
            ]);

            // Asignar permisos - asegurar que sea un array
            $permissions = is_array($request->permissions) ? $request->permissions : [];
            
            if (!empty($permissions)) {
                // Convertir a enteros para asegurar el tipo correcto
                $permissionIds = array_map('intval', $permissions);
                $role->permissions()->attach($permissionIds);
                
                Log::info('Role created with permissions:', [
                    'role_id' => $role->id,
                    'permission_ids' => $permissionIds
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Rol creado exitosamente con ' . count($permissions) . ' permisos',
                'role' => $role->load('permissions')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en RoleController@store: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error al crear el rol: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        $role->load(['users', 'permissions']);
        return view('module.roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // Obtener permisos reales de la base de datos
        $permissions = Permission::orderBy('name')->get();
        $role->load('permissions');
        
        // Organizar permisos por módulos (igual que en create)
        $modules = [
            [
                'key' => 'usuarios',
                'name' => 'USUARIOS',
                'description' => 'Gestión de usuarios del sistema',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'usuarios');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ],
            [
                'key' => 'roles',
                'name' => 'ROLES',
                'description' => 'Gestión de roles y permisos',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'roles');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ],
            [
                'key' => 'dashboard',
                'name' => 'DASHBOARD',
                'description' => 'Acceso al panel principal',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'dashboard');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ],
            [
                'key' => 'profile',
                'name' => 'PERFIL',
                'description' => 'Gestión del perfil de usuario',
                'permissions' => $permissions->filter(function($permission) {
                    return str_contains($permission->name, 'profile');
                })->map(function($permission) {
                    return [
                        'id' => $permission->id,
                        'key' => $permission->name,
                        'name' => $this->getPermissionDisplayName($permission->name)
                    ];
                })->values()->toArray()
            ]
        ];

        return view('module.roles.edit', compact('role', 'modules'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        try {
            // Log de los datos recibidos para debug
            Log::info('Updating role with data:', [
                'role_id' => $role->id,
                'name' => $request->name,
                'permissions' => $request->permissions,
                'permissions_count' => is_array($request->permissions) ? count($request->permissions) : 0
            ]);

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
                'description' => 'nullable|string|max:500',
                'permissions' => 'required|array|min:1',
                'permissions.*' => 'required|integer|exists:permissions,id'
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed for role update:', $validator->errors()->toArray());
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            DB::beginTransaction();

            $role->update([
                'name' => $request->name,
                'description' => $request->description
            ]);

            // Sincronizar permisos - asegurar que sea un array
            $permissions = is_array($request->permissions) ? $request->permissions : [];
            
            if (!empty($permissions)) {
                // Convertir a enteros para asegurar el tipo correcto
                $permissionIds = array_map('intval', $permissions);
                $role->permissions()->sync($permissionIds);
                
                Log::info('Role updated with permissions:', [
                    'role_id' => $role->id,
                    'permission_ids' => $permissionIds
                ]);
            } else {
                $role->permissions()->detach();
                Log::info('Role updated without permissions:', [
                    'role_id' => $role->id
                ]);
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Rol actualizado exitosamente con ' . count($permissions) . ' permisos',
                'role' => $role->load('permissions')
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en RoleController@update: ' . $e->getMessage(), [
                'request_data' => $request->all(),
                'role_id' => $role->id,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar el rol: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            // Verificar si el rol tiene usuarios asignados
            if ($role->users()->count() > 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se puede eliminar el rol porque tiene usuarios asignados'
                ], 422);
            }

            DB::beginTransaction();

            // Desasociar permisos
            $role->permissions()->detach();
            
            // Eliminar rol
            $role->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Rol eliminado exitosamente'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error en RoleController@destroy: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el rol'
            ], 500);
        }
    }


    /**
     * Get role data for modal
     */
    public function getRoleData(Role $role)
    {
        try {
            $role->load('permissions');
            return response()->json([
                'success' => true,
                'role' => $role
            ]);
        } catch (\Exception $e) {
            Log::error('Error en RoleController@getRoleData: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener los datos del rol'
            ], 500);
        }
    }
}
