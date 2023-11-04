<?php

namespace App\Traits;

trait HasEnumValues
{
    /**
     * @return array
     */
    public static function getStringValues(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * @return array
     */
    public static function getKeyValue(): array
    {
        $data = self::cases();
        $result = [];

        foreach ($data as $element) {
            $result[$element->value] = $element->value;
        }

        return $result;
    }
}
