<?php

namespace EnricoDeLazzari\Wethod;

use DateTimeInterface;

/**
 * Builds the operator-prefixed values Wethod list endpoints accept for
 * filterable fields, e.g. `gte:2024-01-01`, `in:1,2,3`, `bt:0,100`.
 *
 * Example:
 *
 *     $wethod->budget()->listBudgets(updatedAt: Filter::gte($since));
 */
final class Filter
{
    public static function eq(mixed $value): string
    {
        return 'eq:'.self::format($value);
    }

    public static function notEq(mixed $value): string
    {
        return 'neq:'.self::format($value);
    }

    public static function gt(mixed $value): string
    {
        return 'gt:'.self::format($value);
    }

    public static function gte(mixed $value): string
    {
        return 'gte:'.self::format($value);
    }

    public static function lt(mixed $value): string
    {
        return 'lt:'.self::format($value);
    }

    public static function lte(mixed $value): string
    {
        return 'lte:'.self::format($value);
    }

    /**
     * @param  array<int, mixed>  $values
     */
    public static function in(array $values): string
    {
        return 'in:'.self::formatList($values);
    }

    /**
     * @param  array<int, mixed>  $values
     */
    public static function notIn(array $values): string
    {
        return 'nin:'.self::formatList($values);
    }

    public static function between(mixed $min, mixed $max): string
    {
        return 'bt:'.self::format($min).','.self::format($max);
    }

    private static function format(mixed $value): string
    {
        return match (true) {
            $value instanceof DateTimeInterface => $value->format('Y-m-d\TH:i:sP'),
            is_bool($value) => $value ? 'true' : 'false',
            default => (string) $value,
        };
    }

    /**
     * @param  array<int, mixed>  $values
     */
    private static function formatList(array $values): string
    {
        return implode(',', array_map(self::format(...), $values));
    }
}
