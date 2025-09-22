<?php

namespace Tests\Unit;

use App\Enums\EmploymentStatus;
use PHPUnit\Framework\TestCase;

class EmploymentStatusTest extends TestCase
{
    public function test_enum_values()
    {
        $this->assertEquals('disponible', EmploymentStatus::DISPONIBLE->value);
        $this->assertEquals('en_proceso', EmploymentStatus::EN_PROCESO->value);
        $this->assertEquals('contratado', EmploymentStatus::CONTRATADO->value);
        $this->assertEquals('part_time', EmploymentStatus::PART_TIME->value);
        $this->assertEquals('pendiente', EmploymentStatus::PENDIENTE->value);
        $this->assertEquals('parcial', EmploymentStatus::PARCIAL->value);
        $this->assertEquals('certificado', EmploymentStatus::CERTIFICADO->value);
        $this->assertEquals('despido', EmploymentStatus::DESPIDO->value);
        $this->assertEquals('desalicio', EmploymentStatus::DESALICIO->value);
        $this->assertEquals('renuncia', EmploymentStatus::RENUNCIA->value);
        $this->assertEquals('aplica', EmploymentStatus::APLICA->value);
        $this->assertEquals('no_aplica', EmploymentStatus::NO_APLICA->value);
    }

    public function test_get_label()
    {
        $this->assertEquals('Disponible', EmploymentStatus::DISPONIBLE->getLabel());
        $this->assertEquals('En Proceso', EmploymentStatus::EN_PROCESO->getLabel());
        $this->assertEquals('Contratado', EmploymentStatus::CONTRATADO->getLabel());
        $this->assertEquals('Part-Time', EmploymentStatus::PART_TIME->getLabel());
        $this->assertEquals('Pendiente', EmploymentStatus::PENDIENTE->getLabel());
        $this->assertEquals('Parcial', EmploymentStatus::PARCIAL->getLabel());
        $this->assertEquals('Certificado', EmploymentStatus::CERTIFICADO->getLabel());
        $this->assertEquals('Despido', EmploymentStatus::DESPIDO->getLabel());
        $this->assertEquals('Desalicio', EmploymentStatus::DESALICIO->getLabel());
        $this->assertEquals('Renuncia', EmploymentStatus::RENUNCIA->getLabel());
        $this->assertEquals('Aplica', EmploymentStatus::APLICA->getLabel());
        $this->assertEquals('No Aplica', EmploymentStatus::NO_APLICA->getLabel());
    }

    public function test_get_options()
    {
        $options = EmploymentStatus::getOptions();
        
        $expected = [
            'disponible' => 'Disponible',
            'en_proceso' => 'En Proceso',
            'contratado' => 'Contratado',
            'part_time' => 'Part-Time',
            'pendiente' => 'Pendiente',
            'parcial' => 'Parcial',
            'certificado' => 'Certificado',
            'despido' => 'Despido',
            'desalicio' => 'Desalicio',
            'renuncia' => 'Renuncia',
            'aplica' => 'Aplica',
            'no_aplica' => 'No Aplica',
        ];
        
        $this->assertEquals($expected, $options);
    }

    public function test_get_active_statuses()
    {
        $activeStatuses = EmploymentStatus::getActiveStatuses();
        
        $this->assertContains(EmploymentStatus::DISPONIBLE, $activeStatuses);
        $this->assertContains(EmploymentStatus::EN_PROCESO, $activeStatuses);
        $this->assertContains(EmploymentStatus::CONTRATADO, $activeStatuses);
        $this->assertContains(EmploymentStatus::PART_TIME, $activeStatuses);
        $this->assertContains(EmploymentStatus::PENDIENTE, $activeStatuses);
        $this->assertContains(EmploymentStatus::PARCIAL, $activeStatuses);
        $this->assertContains(EmploymentStatus::CERTIFICADO, $activeStatuses);
        
        $this->assertNotContains(EmploymentStatus::DESPIDO, $activeStatuses);
        $this->assertNotContains(EmploymentStatus::DESALICIO, $activeStatuses);
        $this->assertNotContains(EmploymentStatus::RENUNCIA, $activeStatuses);
    }

    public function test_get_termination_statuses()
    {
        $terminationStatuses = EmploymentStatus::getTerminationStatuses();
        
        $this->assertContains(EmploymentStatus::DESPIDO, $terminationStatuses);
        $this->assertContains(EmploymentStatus::DESALICIO, $terminationStatuses);
        $this->assertContains(EmploymentStatus::RENUNCIA, $terminationStatuses);
        
        $this->assertNotContains(EmploymentStatus::DISPONIBLE, $terminationStatuses);
        $this->assertNotContains(EmploymentStatus::CONTRATADO, $terminationStatuses);
    }

    public function test_get_application_statuses()
    {
        $applicationStatuses = EmploymentStatus::getApplicationStatuses();
        
        $this->assertContains(EmploymentStatus::APLICA, $applicationStatuses);
        $this->assertContains(EmploymentStatus::NO_APLICA, $applicationStatuses);
        
        $this->assertNotContains(EmploymentStatus::DISPONIBLE, $applicationStatuses);
        $this->assertNotContains(EmploymentStatus::CONTRATADO, $applicationStatuses);
    }

    public function test_is_valid()
    {
        $this->assertTrue(EmploymentStatus::isValid('disponible'));
        $this->assertTrue(EmploymentStatus::isValid('en_proceso'));
        $this->assertTrue(EmploymentStatus::isValid('contratado'));
        $this->assertTrue(EmploymentStatus::isValid('part_time'));
        $this->assertTrue(EmploymentStatus::isValid('pendiente'));
        $this->assertTrue(EmploymentStatus::isValid('parcial'));
        $this->assertTrue(EmploymentStatus::isValid('certificado'));
        $this->assertTrue(EmploymentStatus::isValid('despido'));
        $this->assertTrue(EmploymentStatus::isValid('desalicio'));
        $this->assertTrue(EmploymentStatus::isValid('renuncia'));
        $this->assertTrue(EmploymentStatus::isValid('aplica'));
        $this->assertTrue(EmploymentStatus::isValid('no_aplica'));
        
        $this->assertFalse(EmploymentStatus::isValid('invalid'));
        $this->assertFalse(EmploymentStatus::isValid(''));
    }
}
