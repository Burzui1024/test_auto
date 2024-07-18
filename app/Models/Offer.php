<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'external_id',
        'car_brand_id',
        'car_model_id',
        'car_generation_id',
        'year',
        'run',
        'car_color_id',
        'car_body_type_id',
        'car_engine_type_id',
        'car_transmission_type_id',
        'car_gear_type_id',
        'external_generation_id'
    ];
}
