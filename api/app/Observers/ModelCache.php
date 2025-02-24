<?php

namespace App\Observers;

class ModelCache
{
    public function created($model)
    {
        $model->pushCache($model);
    }

    public function updated($model)
    {
        $model->updateCache($model->id, $model);
    }

    public function deleted($model)
    {
        $model->removeCache($model->id);
    }
}
