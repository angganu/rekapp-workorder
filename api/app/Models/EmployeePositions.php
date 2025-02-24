<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Signature;

class EmployeePositions extends Model
{
    use HasFactory, SoftDeletes, Signature;

    protected $fillable = [
        'employee_id', 'company_id', 'location_id', 'position_id'
    ];
}