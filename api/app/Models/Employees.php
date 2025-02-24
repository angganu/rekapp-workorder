<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Signature;

class Employees extends Model
{
    use HasFactory, SoftDeletes, Signature;

    protected $fillable = [
        'nik', 'name', 'gender', 'phone', 'email', 'address', 'date_active', 'date_disabled', 'is_active'
    ];
}