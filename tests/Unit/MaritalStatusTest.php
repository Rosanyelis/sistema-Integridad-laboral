<?php

namespace Tests\Unit;

use App\Enums\MaritalStatus;
use PHPUnit\Framework\TestCase;

class MaritalStatusTest extends TestCase
{
    public function test_enum_values()
    {
        $this->assertEquals('soltero', MaritalStatus::SOLTERO->value);
        $this->assertEquals('casado', MaritalStatus::CASADO->value);
        $this->assertEquals('viudo', MaritalStatus::VIUDO->value);
    }

    public function test_get_label()
    {
        $this->assertEquals('Soltero(a)', MaritalStatus::SOLTERO->getLabel());
        $this->assertEquals('Casado(a)', MaritalStatus::CASADO->getLabel());
        $this->assertEquals('Viudo(a)', MaritalStatus::VIUDO->getLabel());
    }

    public function test_get_options()
    {
        $options = MaritalStatus::getOptions();
        
        $expected = [
            'soltero' => 'Soltero(a)',
            'casado' => 'Casado(a)',
            'viudo' => 'Viudo(a)',
        ];
        
        $this->assertEquals($expected, $options);
    }

    public function test_get_label_by_value()
    {
        $this->assertEquals('Soltero(a)', MaritalStatus::getLabelByValue('soltero'));
        $this->assertEquals('Casado(a)', MaritalStatus::getLabelByValue('casado'));
        $this->assertEquals('Viudo(a)', MaritalStatus::getLabelByValue('viudo'));
        $this->assertNull(MaritalStatus::getLabelByValue('invalid'));
    }

    public function test_is_valid()
    {
        $this->assertTrue(MaritalStatus::isValid('soltero'));
        $this->assertTrue(MaritalStatus::isValid('casado'));
        $this->assertTrue(MaritalStatus::isValid('viudo'));
        $this->assertFalse(MaritalStatus::isValid('invalid'));
        $this->assertFalse(MaritalStatus::isValid(''));
    }

    public function test_get_cases()
    {
        $cases = MaritalStatus::getCases();
        
        $this->assertCount(3, $cases);
        $this->assertContains(MaritalStatus::SOLTERO, $cases);
        $this->assertContains(MaritalStatus::CASADO, $cases);
        $this->assertContains(MaritalStatus::VIUDO, $cases);
    }
}
