<?php

namespace Akhaled\LaravelRepo\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait CreatedAtNewFirst
{
    public static function bootCreatedAtFirst()
    {
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}