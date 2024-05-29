<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery_time extends Model
{
    use HasFactory;
    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delicery_to',
    ];

}
