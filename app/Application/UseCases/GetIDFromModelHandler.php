<?php

namespace App\Application\UseCases;

use Illuminate\Database\Eloquent\Model;

class GetIDFromModelHandler
{
    /**
     * @param Model|null $model
     * @return int|null
     */
    public function make(?Model $model): int|null
    {
        return $model->id ?? null;
    }
}
