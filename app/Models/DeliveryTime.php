<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'curriculums_id',
        'delivery_from',
        'delicery_to',
    ];

    public static function findByCurriculumId($id)
    {
        return self::where('curriculums_id', $id)->get();
    }
}
