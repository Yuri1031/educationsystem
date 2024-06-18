<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    const DATE_FORMAT = 'Ymd';
    const TIME_FORMAT = 'Hi';

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

    public function getDeliveryDateFrom() {
        return $this->delivery_from->format(self::DATE_FORMAT);
    }

    public function getDeliveryDateTo()
    {
        return $this->delivery_to->format(self::DATE_FORMAT);
    }

    public function getDeliveryTimeFrom()
    {
        return $this->delivery_from->format(self::TIME_FORMAT);
    }

    public function getDeliveryTimeTo()
    {
        return $this->delivery_to->format(self::TIME_FORMAT);
    }

    public static function findByCurriculumId($id)
    {
        return self::where('curriculums_id', $id)->get();
    }

}
