# Módulo People - Form Requests

Este directorio contiene los Form Requests específicos para el módulo de gestión de personal.

## Estructura

```
app/Http/Requests/People/
├── README.md
├── StorePeopleRequest.php    # Validación para crear personal
└── UpdatePeopleRequest.php   # Validación para actualizar personal
```

## Form Requests Disponibles

### StorePeopleRequest
- **Propósito**: Validar datos al crear un nuevo registro de personal
- **Método**: `POST /people`
- **Características**:
  - Validación de unicidad para código y cédula
  - Validación de formato para teléfonos y cédulas
  - Validación de tipos de sangre
  - Cálculo automático de edad
  - Limpieza automática de datos

### UpdatePeopleRequest
- **Propósito**: Validar datos al actualizar un registro de personal existente
- **Método**: `PUT/PATCH /people/{id}`
- **Características**:
  - Validación de unicidad excluyendo el registro actual
  - Mismas validaciones que StorePeopleRequest
  - Soporte para actualización parcial

## Validaciones Implementadas

### Datos de Identificación
- **Código**: Requerido, único, máximo 255 caracteres
- **Nombre**: Requerido, mínimo 2 caracteres, máximo 255
- **Apellidos**: Requerido, mínimo 2 caracteres, máximo 255
- **Cédula**: Requerido, único, formato 7-10 dígitos
- **Cédula Anterior**: Opcional, formato 7-10 dígitos

### Información Personal
- **Fecha de Nacimiento**: Requerido, anterior a hoy, posterior a 1900
- **Edad**: Opcional, entero entre 0-150, se calcula automáticamente
- **Estado Civil**: Opcional, valores del enum MaritalStatus
- **Lugar de Nacimiento**: Requerido, mínimo 2 caracteres
- **País**: Requerido, mínimo 2 caracteres

### Información de Contacto
- **Código Postal**: Opcional, formato 4-6 dígitos
- **Teléfono Celular**: Requerido, formato válido
- **Teléfono Fijo**: Opcional, formato válido
- **Email**: Opcional, formato válido, único

### Redes Sociales
- **Red Social 1**: Opcional, máximo 255 caracteres
- **Red Social 2**: Opcional, máximo 255 caracteres

### Aspiración Laboral
- **Cargo que Aspira**: Requerido, mínimo 2 caracteres
- **Tipo de Sangre**: Opcional, formato A+, B-, AB+, O-
- **Código Empresa**: Opcional, máximo 50 caracteres
- **Nombre Empresa**: Opcional, máximo 255 caracteres

### Información de Salud
- **Alergias a Medicamentos**: Opcional, máximo 1000 caracteres
- **Enfermedades**: Opcional, máximo 1000 caracteres

### Contactos de Emergencia
- **Nombre Contacto**: Requerido, mínimo 2 caracteres
- **Teléfono Contacto**: Requerido, formato válido
- **Otros Contactos**: Opcional, máximo 1000 caracteres

### Estado Laboral
- **Estado Laboral**: Requerido, valores del enum EmploymentStatus

## Características Especiales

### Limpieza Automática de Datos
- Eliminación de caracteres no numéricos en cédulas y teléfonos
- Conversión a mayúsculas en tipos de sangre
- Trim automático en nombres y apellidos

### Validaciones Personalizadas
- Verificación de coherencia entre edad y fecha de nacimiento
- Validación de al menos un teléfono presente
- Validación de formatos específicos para cada campo

### Mensajes de Error Personalizados
- Mensajes en español
- Atributos personalizados para mejor UX
- Mensajes específicos por tipo de validación

## Uso en Controladores

```php
// En PeopleController
public function store(StorePeopleRequest $request)
{
    $validatedData = $request->validated();
    // Los datos ya están validados y limpios
    $person = People::create($validatedData);
    // ...
}

public function update(UpdatePeopleRequest $request, $id)
{
    $validatedData = $request->validated();
    // Los datos ya están validados y limpios
    $person = People::findOrFail($id);
    $person->update($validatedData);
    // ...
}
```

## Extensión

Para agregar nuevas validaciones:

1. Modificar las reglas en el método `rules()`
2. Agregar mensajes personalizados en `messages()`
3. Actualizar atributos en `attributes()` si es necesario
4. Agregar lógica de limpieza en `prepareForValidation()`
5. Agregar validaciones personalizadas en `withValidator()`
