<?php

namespace App\Enums;

enum MaritalStatus: string
{
    case SOLTERO = 'soltero';
    case CASADO = 'casado';
    case VIUDO = 'viudo';

    /**
     * Obtiene el label legible para el estado civil
     */
    public function getLabel(): string
    {
        return match($this) {
            self::SOLTERO => 'Soltero(a)',
            self::CASADO => 'Casado(a)',
            self::VIUDO => 'Viudo(a)',
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
}
