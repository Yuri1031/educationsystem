<?php

namespace App\Models;

use DateTime;
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

    public function getDeliveryFromAttribute($value)
    {
        return new DateTime($value);
    }

    public function getDeliveryToAttribute($value)
    {
        return new DateTime($value);
    }

    public static function findByCurriculumId($id)
    {
        return self::where('curriculums_id', $id)->get();
    }

}
