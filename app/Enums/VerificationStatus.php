<?php

namespace App\Enums;

enum VerificationStatus: string
{
    case PENDIENTE = 'pendiente';
    case PARCIAL = 'parcial';
    case NO_APLICA = 'no_aplica';
    case CERTIFICADO = 'certificado';

    /**
     * Obtiene el label legible para el estado de verificación
     */
    public function getLabel(): string
    {
        return match($this) {
            self::PENDIENTE => 'Pendiente',
            self::PARCIAL => 'Parcial',
            self::NO_APLICA => 'No Aplica',
            self::CERTIFICADO => 'Certificado',
        };
    }

    /**
     * Obtiene todos los valores del enum con sus labels
     */
    public static function getOptions(): array
    {
        return collect(self::cases())->mapWithKeys(function ($case) {
            return [$case->value => $case->getLabel()];
        })->toArray();
    }

    /**
     * Obtiene todos los casos del enum
     */
    public static function getCases(): array
    {
        return self::cases();
    }

    /**
     * Obtiene el label de un valor específico
     */
    public static function getLabelByValue(string $value): ?string
    {
        $case = self::tryFrom($value);
        return $case ? $case->getLabel() : null;
    }

    /**
     * Valida si un valor es válido
     */
    public static function isValid(string $value): bool
    {
        return self::tryFrom($value) !== null;
    }

    /**
     * Obtiene el valor para la base de datos
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Obtiene los estados de verificación activos (en proceso)
     */
    public static function getActiveStatuses(): array
    {
        return [
            self::PENDIENTE,
            self::PARCIAL,
        ];
    }

    /**
     * Obtiene los estados de verificación completos
     */
    public static function getCompletedStatuses(): array
    {
        return [
            self::CERTIFICADO,
        ];
    }

    /**
     * Obtiene los estados de verificación no aplicables
     */
    public static function getNotApplicableStatuses(): array
    {
        return [
            self::NO_APLICA,
        ];
    }

    /**
     * Verifica si es un estado activo (en proceso de verificación)
     */
    public function isActive(): bool
    {
        return in_array($this, self::getActiveStatuses());
    }

    /**
     * Verifica si es un estado completado
     */
    public function isCompleted(): bool
    {
        return in_array($this, self::getCompletedStatuses());
    }

    /**
     * Verifica si no aplica
     */
    public function isNotApplicable(): bool
    {
        return in_array($this, self::getNotApplicableStatuses());
    }

    /**
     * Obtiene el icono para el estado de verificación
     */
    public function getIcon(): string
    {
        return match($this) {
            self::PENDIENTE => '⏳',
            self::PARCIAL => '🔄',
            self::NO_APLICA => '❌',
            self::CERTIFICADO => '✅',
        };
    }

    /**
     * Obtiene la descripción del estado de verificación
     */
    public function getDescription(): string
    {
        return match($this) {
            self::PENDIENTE => 'Verificación pendiente de revisión',
            self::PARCIAL => 'Verificación parcialmente completada',
            self::NO_APLICA => 'No aplica para este caso',
            self::CERTIFICADO => 'Verificación completada y certificada',
        };
    }

    /**
     * Obtiene el color CSS para el estado
     */
    public function getColorClass(): string
    {
        return match($this) {
            self::PENDIENTE => 'warning',
            self::PARCIAL => 'info',
            self::NO_APLICA => 'secondary',
            self::CERTIFICADO => 'success',
        };
    }

    /**
     * Obtiene el color Bootstrap para el estado
     */
    public function getBootstrapColor(): string
    {
        return match($this) {
            self::PENDIENTE => 'warning',
            self::PARCIAL => 'info',
            self::NO_APLICA => 'secondary',
            self::CERTIFICADO => 'success',
        };
    }

    /**
     * Obtiene el progreso de verificación como porcentaje
     */
    public function getProgressPercentage(): int
    {
        return match($this) {
            self::PENDIENTE => 0,
            self::PARCIAL => 50,
            self::NO_APLICA => 0,
            self::CERTIFICADO => 100,
        };
    }
}
