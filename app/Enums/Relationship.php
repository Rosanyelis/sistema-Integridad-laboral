<?php

namespace App\Enums;

enum Relationship: string
{
    case PADRE = 'padre';
    case MADRE = 'madre';
    case CONYUGE = 'conyuge';
    case HERMANO = 'hermano';
    case TIO = 'tio';
    case AMIGO = 'amigo';
    case OTROS = 'otros';

    /**
     * Obtiene el label legible para el tipo de relación
     */
    public function getLabel(): string
    {
        return match($this) {
            self::PADRE => 'Padre',
            self::MADRE => 'Madre',
            self::CONYUGE => 'Cónyuge',
            self::HERMANO => 'Hermano(a)',
            self::TIO => 'Tío(a)',
            self::AMIGO => 'Amigo(a)',
            self::OTROS => 'Otros',
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
     * Obtiene las relaciones familiares directas (padre, madre, cónyuge, hermano)
     */
    public static function getFamilyRelationships(): array
    {
        return [
            self::PADRE,
            self::MADRE,
            self::CONYUGE,
            self::HERMANO,
        ];
    }

    /**
     * Obtiene las relaciones familiares extendidas (tío)
     */
    public static function getExtendedFamilyRelationships(): array
    {
        return [
            self::TIO,
        ];
    }

    /**
     * Obtiene las relaciones no familiares (amigo, otros)
     */
    public static function getNonFamilyRelationships(): array
    {
        return [
            self::AMIGO,
            self::OTROS,
        ];
    }

    /**
     * Verifica si es una relación familiar
     */
    public function isFamilyRelationship(): bool
    {
        return in_array($this, array_merge(
            self::getFamilyRelationships(),
            self::getExtendedFamilyRelationships()
        ));
    }

    /**
     * Verifica si es una relación directa (padre, madre, cónyuge, hermano)
     */
    public function isDirectFamilyRelationship(): bool
    {
        return in_array($this, self::getFamilyRelationships());
    }

    /**
     * Obtiene el icono o emoji para la relación
     */
    public function getIcon(): string
    {
        return match($this) {
            self::PADRE => '👨',
            self::MADRE => '👩',
            self::CONYUGE => '💑',
            self::HERMANO => '👫',
            self::TIO => '👨‍👩‍👧‍👦',
            self::AMIGO => '👥',
            self::OTROS => '❓',
        };
    }

    /**
     * Obtiene la descripción de la relación
     */
    public function getDescription(): string
    {
        return match($this) {
            self::PADRE => 'Relación paterna',
            self::MADRE => 'Relación materna',
            self::CONYUGE => 'Pareja o esposo(a)',
            self::HERMANO => 'Hermano o hermana',
            self::TIO => 'Tío o tía',
            self::AMIGO => 'Amigo o amiga',
            self::OTROS => 'Otra relación no especificada',
        };
    }
}
