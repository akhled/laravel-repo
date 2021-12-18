<?php

namespace Akhaled\LaravelRepo\Eloquent\Concerns;

use Illuminate\Database\Eloquent\Builder;

trait CreatedAtNewFirst
{
    public static function booted()
    {
        parent::booted();

        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}