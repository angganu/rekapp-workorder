<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Signature;

class MstLocations extends Model
{
    use HasFactory, SoftDeletes, Signature;

    protected $fillable = [
        'company_id', 'code', 'name', 'address', 'description'
    ];
}