<?php

declare(strict_types=1);

namespace Paysera\CheckoutSdk\Util;

class TypeConverter
{
    public const DEFAULT = 1;
    public const BOOL = 2;
    public const INT = 3;
    public const FLOAT = 4;

    protected const ACCEPTED_TYPES =
        [
            self::BOOL => [TypeConverter::class, 'castToBoolean'],
            self::INT => [TypeConverter::class, 'castToInteger'],
            self::FLOAT => [TypeConverter::class, 'castToFloat'],
        ]
    ;

    /**
     * @param mixed $value
     * @param int $type
     * @return mixed
     */
    public function convert($value, int $type = self::DEFAULT)
    {
        if (array_key_exists($type, static::ACCEPTED_TYPES) === false) {
            return $value;
        }

        return call_user_func(self::ACCEPTED_TYPES[$type], $value);
    }

    /**
     * @param mixed $value
     * @return int
     */
    protected function castToInteger($value): int
    {
        return (int) $value;
    }

    /**
     * @param mixed $value
     * @return float
     */
    protected function castToFloat($value): float
    {
        return (float) $value;
    }

    /**
     * @param mixed $value
     * @return bool
     */
    protected function castToBoolean($value): bool
    {
        if (is_string($value)) {
            return filter_var(trim($value), FILTER_VALIDATE_BOOLEAN);
        }
        return (bool) $value;
    }
}
