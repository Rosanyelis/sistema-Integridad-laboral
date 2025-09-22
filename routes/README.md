# Route Templates

Este archivo contiene plantillas de rutas reutilizables para el sistema de integridad laboral.

## Estructura del Archivo

El archivo `routetemplates.php` está organizado en secciones temáticas:

### 1. Rutas de Personas (PEOPLES)
- **Prefijo:** `/peoples`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - CRUD básico (index, create, store, show, edit, update, destroy)
  - Perfil completo (profile, residence, references, education, experience, aspirations)
  - Gestión de datos (data, upload-photo, remove-photo)
  - Exportación/Importación (export/excel, export/pdf, import)
  - Búsqueda y filtros (search, filter)
  - Estadísticas (statistics, employment, education)

### 2. Rutas de Roles
- **Prefijo:** `/roles`
- **Controlador:** `RoleController`
- **Funcionalidades:**
  - CRUD básico
  - Gestión de permisos
  - Asignación de usuarios

### 3. Rutas de Usuarios
- **Prefijo:** `/users`
- **Controlador:** `UserController`
- **Funcionalidades:**
  - CRUD básico
  - Gestión de perfil
  - Asignación de roles
  - Control de estado (activate/deactivate)

### 4. Rutas de Referencias Personales
- **Prefijo:** `/personal-references`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - CRUD básico
  - Filtros por relación (family, non-family, by-relationship)

### 5. Rutas de Información de Residencia
- **Prefijo:** `/residence-information`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - CRUD básico
  - Filtros geográficos (by-province, by-municipality, by-sector)
  - Información certificada

### 6. Rutas de Habilidades Educativas
- **Prefijo:** `/educational-skills`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - CRUD básico
  - Filtros educativos (by-career, by-center, by-year)
  - Graduaciones recientes

### 7. Rutas de Experiencias Laborales
- **Prefijo:** `/work-experiences`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - CRUD básico
  - Filtros laborales (by-company, by-position)
  - Experiencias actuales/pasadas/recientes

### 8. Rutas de Aspiraciones
- **Prefijo:** `/aspirations`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - CRUD básico
  - Filtros por ocupación y disponibilidad
  - Tiempo completo/parcial

### 9. Rutas de Dashboard
- **Prefijo:** `/dashboard`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - Vista general
  - Estadísticas
  - Reportes
  - Analytics

### 10. Rutas de API
- **Prefijo:** `/api`
- **Controladores:** Varios
- **Funcionalidades:**
  - Endpoints REST para integración externa
  - CRUD básico para personas, roles y usuarios

### 11. Rutas de Utilidades
- **Prefijo:** `/utils`
- **Controlador:** `PersonController`
- **Funcionalidades:**
  - Generación de códigos únicos
  - Validación de datos
  - Exportación/Importación
  - Búsqueda global

## Convenciones de Nomenclatura

### Nombres de Rutas
- **Formato:** `{recurso}.{accion}`
- **Ejemplos:** `peoples.index`, `roles.create`, `users.show`

### Prefijos
- **Formato:** `{recurso}` (plural)
- **Ejemplos:** `peoples`, `roles`, `users`

### Parámetros
- **Formato:** `{recurso}` (singular)
- **Ejemplos:** `{person}`, `{role}`, `{user}`

## Integración con Bootstrap

El archivo se carga automáticamente en `bootstrap/app.php` usando el método `then()`:

```php
->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
    then: function () {
        Route::middleware('web')
            ->group(base_path('routes/routetemplates.php'));
    },
)
```

## Uso de las Rutas

### En Controladores
```php
return redirect()->route('peoples.index');
return redirect()->route('roles.show', $role);
```

### En Vistas Blade
```blade
<a href="{{ route('peoples.create') }}">Crear Persona</a>
<a href="{{ route('roles.edit', $role) }}">Editar Rol</a>
```

### En JavaScript
```javascript
fetch(route('peoples.search'), {
    method: 'POST',
    body: formData
});
```

## Extensión de las Plantillas

Para agregar nuevas rutas:

1. **Agregar en la sección correspondiente** del archivo `routetemplates.php`
2. **Seguir las convenciones** de nomenclatura establecidas
3. **Documentar** la nueva funcionalidad en este README
4. **Actualizar** los controladores correspondientes

## Notas Importantes

- Todas las rutas están protegidas por el middleware `web`
- Las rutas siguen el patrón RESTful cuando es posible
- Los nombres de rutas son consistentes y descriptivos
- Las rutas están organizadas por funcionalidad para facilitar el mantenimiento
