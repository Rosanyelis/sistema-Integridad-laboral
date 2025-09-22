<?php

namespace Tests\Feature;

use App\Models\People;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PersonObserverTest extends TestCase
{
    use RefreshDatabase;

    public function test_generates_unique_code_on_creation()
    {
        // Simular una fecha específica para testing
        Carbon::setTestNow(Carbon::create(2025, 9, 21, 10, 0, 0));
        
        $person = People::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'dni' => '12345678',
            'country' => 'Venezuela',
            'birth_place' => 'Caracas',
            'birth_date' => '1990-01-01',
        ]);

        $this->assertNotNull($person->code_unique);
        $this->assertStringStartsWith('01-', $person->code_unique);
        $this->assertStringEndsWith('21092025', $person->code_unique);
        $this->assertEquals('01-21092025', $person->code_unique);
    }

    public function test_generates_sequential_codes_for_same_day()
    {
        Carbon::setTestNow(Carbon::create(2025, 9, 21, 10, 0, 0));
        
        // Crear primera persona
        $person1 = Person::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'dni' => '12345678',
            'country' => 'Venezuela',
            'birth_place' => 'Caracas',
            'birth_date' => '1990-01-01',
        ]);

        // Crear segunda persona
        $person2 = Person::create([
            'name' => 'María',
            'last_name' => 'González',
            'dni' => '87654321',
            'country' => 'Venezuela',
            'birth_place' => 'Valencia',
            'birth_date' => '1992-05-15',
        ]);

        $this->assertEquals('01-21092025', $person1->code_unique);
        $this->assertEquals('02-21092025', $person2->code_unique);
    }

    public function test_generates_different_codes_for_different_days()
    {
        // Primera persona en día 1
        Carbon::setTestNow(Carbon::create(2025, 9, 21, 10, 0, 0));
        $person1 = Person::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'dni' => '12345678',
            'country' => 'Venezuela',
            'birth_place' => 'Caracas',
            'birth_date' => '1990-01-01',
        ]);

        // Segunda persona en día 2
        Carbon::setTestNow(Carbon::create(2025, 9, 22, 10, 0, 0));
        $person2 = Person::create([
            'name' => 'María',
            'last_name' => 'González',
            'dni' => '87654321',
            'country' => 'Venezuela',
            'birth_place' => 'Valencia',
            'birth_date' => '1992-05-15',
        ]);

        $this->assertEquals('01-21092025', $person1->code_unique);
        $this->assertEquals('01-22092025', $person2->code_unique);
    }

    public function test_does_not_modify_existing_code_unique()
    {
        $person = People::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'dni' => '12345678',
            'country' => 'Venezuela',
            'birth_place' => 'Caracas',
            'birth_date' => '1990-01-01',
            'code_unique' => 'CUSTOM-CODE-123', // Código personalizado
        ]);

        $this->assertEquals('CUSTOM-CODE-123', $person->code_unique);
    }

    public function test_prevents_modification_of_code_unique_on_update()
    {
        $person = People::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'dni' => '12345678',
            'country' => 'Venezuela',
            'birth_place' => 'Caracas',
            'birth_date' => '1990-01-01',
        ]);

        $originalCode = $person->code_unique;
        
        // Intentar modificar el código
        $person->update([
            'name' => 'Juan Carlos',
            'code_unique' => 'MODIFIED-CODE-123'
        ]);

        // El código no debe haber cambiado
        $this->assertEquals($originalCode, $person->fresh()->code_unique);
        $this->assertNotEquals('MODIFIED-CODE-123', $person->fresh()->code_unique);
    }

    public function test_code_format_is_correct()
    {
        Carbon::setTestNow(Carbon::create(2025, 12, 31, 10, 0, 0));
        
        $person = People::create([
            'name' => 'Juan',
            'last_name' => 'Pérez',
            'dni' => '12345678',
            'country' => 'Venezuela',
            'birth_place' => 'Caracas',
            'birth_date' => '1990-01-01',
        ]);

        // Verificar formato: XX-DDMMYYYY
        $this->assertMatchesRegularExpression('/^\d{2}-\d{8}$/', $person->code_unique);
        $this->assertEquals('01-31122025', $person->code_unique);
    }

    protected function tearDown(): void
    {
        Carbon::setTestNow(); // Reset Carbon
        parent::tearDown();
    }
}
