<?php

namespace App\Traits;

use App\Observers\Signature as SignatureObserver;
use App\Models\User as Model;

trait Signature
{
    /**
     * The "booting" method of the Signature.
     *
     * @return void
     */

    public static function bootSignature()
    {
        static::observe(new SignatureObserver);
    }

    /**
     * Get the user that owns the current model.
     */
    public function createdUser()
    {
        return $this->belongsTo(Model::class, 'created_by');
    }

    /**
     * Get the user that owns the current model.
     */
    public function updatedUser()
    {
        return $this->belongsTo(Model::class, 'updated_by');
    }


}