<?php

namespace App\Services\Traits;

use Illuminate\Support\Str;

trait HasUuid
{
    protected static function bootHasUuid()
    {
        static::creating(static::getCreatingUuidHandler());
    }
    protected static function getCreatingUuidHandler(): \Closure
    {
        return function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::orderedUuid();
            }
        };
    }
    public static function findByUuid(?string $uuid): ?self
    {
        return self::where('uuid', $uuid)->first();
    }
}
