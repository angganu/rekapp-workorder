<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Signature;

class PersonalAccessTokens extends Model
{
    use HasFactory, Signature;

    protected $fillable = [
        'expires_at'
    ];
}