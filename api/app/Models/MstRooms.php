<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MstRooms extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'location_id', 'area_id', 'room_category_id', 'code', 'name', 'description'
    ];
}