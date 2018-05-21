<?php

namespace common\traits;

/**
 * Trait ActiveRecordTrait
 * @package common\traits
 */
trait ActiveRecordTrait
{
    /**
     * Return full name of AR field with table name.
     * @param string $name
     * @return string
     */
    public static function field($name)
    {
        return static::tableName() . '.' . $name;
    }
}