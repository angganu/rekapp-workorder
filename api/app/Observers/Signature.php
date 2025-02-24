<?php

namespace App\Observers;

use Illuminate\Support\Facades\Auth;

class Signature
{
    public function creating($model)
    {
        $model->created_by = $this->getId();
        $model->updated_by = $this->getId();
    }

    public function updating($model)
    {
        $model->updated_by = $this->getId();
    }

    public function deleting($model)
    {
        $model->deleted_by = $this->getId();
    }

    /*
    public function created(User $user): void
    {
        //
    }
    public function updated(User $user): void
    {
        //
    }
    public function deleted(User $user): void
    {
        //
    }
    public function restored(User $user): void
    {
        //
    }
    public function forceDeleted(User $user): void
    {
        //
    }
    */

    public function getId(){
        return Auth::id() ? Auth::id() : 0;
    }

}
