<?php

namespace App\Services\Traits;

use Illuminate\Support\Str;

/**
 *Handle UUIds for model objects
 */
trait HasUuid
{
    /**
     * @param string|null $uuid
     * @return static|null
     */
    public static function findByUuid(?string $uuid): ?self
    {
        return self::where('uuid', $uuid)->first();
    }

    /**
     *Run on model boot when creating a new record
     */
    protected static function bootHasUuid()
    {
        static::creating(static::getCreatingUuidHandler());
    }

    /**
     * @return \Closure
     */
    protected static function getCreatingUuidHandler(): \Closure
    {
        return function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string)Str::orderedUuid();
            }
        };
    }
}
