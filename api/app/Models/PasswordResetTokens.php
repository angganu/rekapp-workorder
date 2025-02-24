<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Signature;

class PasswordResetTokens extends Model
{
    use HasFactory, Signature;

    protected $fillable = [
        'email', 'token', 'expired_at', 'created_at', 'updated_at'
    ];
}