<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarGeneration extends Model
{
    use HasFactory;

    protected $fillable = ['generation', 'car_model_id', 'car_brand_id'];
}
