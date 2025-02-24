<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Signature;

class MstAreas extends Model
{
    use HasFactory, SoftDeletes, Signature;

    protected $fillable = [
        'location_id', 'code', 'type', 'name', 'description'
    ];
}