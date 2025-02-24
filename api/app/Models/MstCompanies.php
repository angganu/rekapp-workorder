<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Signature;

class MstCompanies extends Model
{
    use HasFactory, SoftDeletes, Signature;

    protected $fillable = [
        'code', 'name', 'legal_name', 'alias', 'description'
    ];
}