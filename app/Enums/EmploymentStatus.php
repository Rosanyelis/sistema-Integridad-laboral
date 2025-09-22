<?php

namespace App\Enums;

enum EmploymentStatus: string
{
    case PENDIENTE = 'pendiente';
    case DISPONIBLE = 'disponible';
    case EN_PROCESO = 'en_proceso';
    case CONTRATADO = 'contratado';
    case PART_TIME = 'part_time';
    case DESPIDO = 'despido';
    case DESAUCIO = 'desaucio';
    case RENUNCIA = 'renuncia';
    case APLICA = 'aplica';
    case NO_APLICA = 'no_aplica';

    /**
     * Obtiene el label legible para el estatus laboral
     */
    public function getLabel(): string
    {
        return match($this) {
            self::PENDIENTE => 'Pendiente',
            self::DISPONIBLE => 'Disponible',
            self::EN_PROCESO => 'En Proceso',
            self::CONTRATADO => 'Contratado',
            self::PART_TIME => 'Part-Time',
            self::DESPIDO => 'Despido',
            self::DESAUCIO => 'Desaucio',
            self::RENUNCIA => 'Renuncia',
            self::APLICA => 'Aplica',
            self::NO_APLICA => 'No Aplica',
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
     * Obtiene los estatus activos (disponibles para seleccionar)
     */
    public static function getActiveStatuses(): array
    {
        return [
            self::PENDIENTE,
            self::DISPONIBLE,
            self::EN_PROCESO,
            self::CONTRATADO,
            self::PART_TIME,
        ];
    }

    /**
     * Obtiene los estatus de finalización
     */
    public static function getTerminationStatuses(): array
    {
        return [
            self::DESPIDO,
            self::DESAUCIO,
            self::RENUNCIA,
        ];
    }

    /**
     * Obtiene los estatus de aplicación
     */
    public static function getApplicationStatuses(): array
    {
        return [
            self::APLICA,
            self::NO_APLICA,
        ];
    }
}
