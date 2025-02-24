<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Signature;

class MstAssets extends Model
{
    use HasFactory, SoftDeletes, Signature;

    protected $fillable = [
        'asset_category_id', 'company_id', 'location_id', 'area_id', 'room_id', 'code', 'name', 'description', 'last_maintenance', 'next_maintenance'
    ];
}