<?php

namespace Akhaled\LaravelRepo\Eloquent;

use AwesIO\Repository\Eloquent\BaseRepository as BaseBaseRepository;

abstract class BaseRepository extends BaseBaseRepository
{
    public function smartPaginate($perPage = null, $columns = ['*'])
    {
        if (method_exists($this, 'scope')) {
            $this->scope(request());
        }

        return parent::smartPaginate();
    }
}
