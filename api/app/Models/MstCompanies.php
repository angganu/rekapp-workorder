<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstCompanies extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code', 'name', 'legal_name', 'alias', 'description'
    ];
}