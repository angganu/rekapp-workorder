<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeePositions extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'employee_id', 'company_id', 'location_id', 'position_id'
    ];
}