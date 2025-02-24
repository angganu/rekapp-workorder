<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Signature;

class PersonalBearierTokens extends Model
{
    use HasFactory, Signature;

    protected $fillable = [
        'user_id', 'access_token_id', 'token', 'is_active'
    ];
}