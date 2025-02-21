<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employess extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'nik', 'name', 'gender', 'phone', 'email', 'address', 'date_active', 'date_disabled'
    ];
}