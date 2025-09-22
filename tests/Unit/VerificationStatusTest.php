<?php

namespace Tests\Unit;

use App\Enums\VerificationStatus;
use PHPUnit\Framework\TestCase;

class VerificationStatusTest extends TestCase
{
    public function test_enum_values()
    {
        $this->assertEquals('pendiente', VerificationStatus::PENDIENTE->value);
        $this->assertEquals('parcial', VerificationStatus::PARCIAL->value);
        $this->assertEquals('no_aplica', VerificationStatus::NO_APLICA->value);
        $this->assertEquals('certificado', VerificationStatus::CERTIFICADO->value);
    }

    public function test_get_label()
    {
        $this->assertEquals('Pendiente', VerificationStatus::PENDIENTE->getLabel());
        $this->assertEquals('Parcial', VerificationStatus::PARCIAL->getLabel());
        $this->assertEquals('No Aplica', VerificationStatus::NO_APLICA->getLabel());
        $this->assertEquals('Certificado', VerificationStatus::CERTIFICADO->getLabel());
    }

    public function test_get_options()
    {
        $options = VerificationStatus::getOptions();
        
        $expected = [
            'pendiente' => 'Pendiente',
            'parcial' => 'Parcial',
            'no_aplica' => 'No Aplica',
            'certificado' => 'Certificado',
        ];
        
        $this->assertEquals($expected, $options);
    }

    public function test_get_active_statuses()
    {
        $activeStatuses = VerificationStatus::getActiveStatuses();
        
        $this->assertContains(VerificationStatus::PENDIENTE, $activeStatuses);
        $this->assertContains(VerificationStatus::PARCIAL, $activeStatuses);
        
        $this->assertNotContains(VerificationStatus::NO_APLICA, $activeStatuses);
        $this->assertNotContains(VerificationStatus::CERTIFICADO, $activeStatuses);
    }

    public function test_get_completed_statuses()
    {
        $completedStatuses = VerificationStatus::getCompletedStatuses();
        
        $this->assertContains(VerificationStatus::CERTIFICADO, $completedStatuses);
        
        $this->assertNotContains(VerificationStatus::PENDIENTE, $completedStatuses);
        $this->assertNotContains(VerificationStatus::PARCIAL, $completedStatuses);
        $this->assertNotContains(VerificationStatus::NO_APLICA, $completedStatuses);
    }

    public function test_get_not_applicable_statuses()
    {
        $notApplicableStatuses = VerificationStatus::getNotApplicableStatuses();
        
        $this->assertContains(VerificationStatus::NO_APLICA, $notApplicableStatuses);
        
        $this->assertNotContains(VerificationStatus::PENDIENTE, $notApplicableStatuses);
        $this->assertNotContains(VerificationStatus::PARCIAL, $notApplicableStatuses);
        $this->assertNotContains(VerificationStatus::CERTIFICADO, $notApplicableStatuses);
    }

    public function test_is_active()
    {
        $this->assertTrue(VerificationStatus::PENDIENTE->isActive());
        $this->assertTrue(VerificationStatus::PARCIAL->isActive());
        
        $this->assertFalse(VerificationStatus::NO_APLICA->isActive());
        $this->assertFalse(VerificationStatus::CERTIFICADO->isActive());
    }

    public function test_is_completed()
    {
        $this->assertTrue(VerificationStatus::CERTIFICADO->isCompleted());
        
        $this->assertFalse(VerificationStatus::PENDIENTE->isCompleted());
        $this->assertFalse(VerificationStatus::PARCIAL->isCompleted());
        $this->assertFalse(VerificationStatus::NO_APLICA->isCompleted());
    }

    public function test_is_not_applicable()
    {
        $this->assertTrue(VerificationStatus::NO_APLICA->isNotApplicable());
        
        $this->assertFalse(VerificationStatus::PENDIENTE->isNotApplicable());
        $this->assertFalse(VerificationStatus::PARCIAL->isNotApplicable());
        $this->assertFalse(VerificationStatus::CERTIFICADO->isNotApplicable());
    }

    public function test_get_icon()
    {
        $this->assertEquals('⏳', VerificationStatus::PENDIENTE->getIcon());
        $this->assertEquals('🔄', VerificationStatus::PARCIAL->getIcon());
        $this->assertEquals('❌', VerificationStatus::NO_APLICA->getIcon());
        $this->assertEquals('✅', VerificationStatus::CERTIFICADO->getIcon());
    }

    public function test_get_description()
    {
        $this->assertEquals('Verificación pendiente de revisión', VerificationStatus::PENDIENTE->getDescription());
        $this->assertEquals('Verificación parcialmente completada', VerificationStatus::PARCIAL->getDescription());
        $this->assertEquals('No aplica para este caso', VerificationStatus::NO_APLICA->getDescription());
        $this->assertEquals('Verificación completada y certificada', VerificationStatus::CERTIFICADO->getDescription());
    }

    public function test_get_color_class()
    {
        $this->assertEquals('warning', VerificationStatus::PENDIENTE->getColorClass());
        $this->assertEquals('info', VerificationStatus::PARCIAL->getColorClass());
        $this->assertEquals('secondary', VerificationStatus::NO_APLICA->getColorClass());
        $this->assertEquals('success', VerificationStatus::CERTIFICADO->getColorClass());
    }

    public function test_get_bootstrap_color()
    {
        $this->assertEquals('warning', VerificationStatus::PENDIENTE->getBootstrapColor());
        $this->assertEquals('info', VerificationStatus::PARCIAL->getBootstrapColor());
        $this->assertEquals('secondary', VerificationStatus::NO_APLICA->getBootstrapColor());
        $this->assertEquals('success', VerificationStatus::CERTIFICADO->getBootstrapColor());
    }

    public function test_get_progress_percentage()
    {
        $this->assertEquals(0, VerificationStatus::PENDIENTE->getProgressPercentage());
        $this->assertEquals(50, VerificationStatus::PARCIAL->getProgressPercentage());
        $this->assertEquals(0, VerificationStatus::NO_APLICA->getProgressPercentage());
        $this->assertEquals(100, VerificationStatus::CERTIFICADO->getProgressPercentage());
    }

    public function test_is_valid()
    {
        $this->assertTrue(VerificationStatus::isValid('pendiente'));
        $this->assertTrue(VerificationStatus::isValid('parcial'));
        $this->assertTrue(VerificationStatus::isValid('no_aplica'));
        $this->assertTrue(VerificationStatus::isValid('certificado'));
        
        $this->assertFalse(VerificationStatus::isValid('invalid'));
        $this->assertFalse(VerificationStatus::isValid(''));
    }
}
