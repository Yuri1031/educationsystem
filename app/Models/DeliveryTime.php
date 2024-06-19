<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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

    public function setDeliveryFrom($date, $time)
    {
        $this->delivery_from = self::createDatetime($date, $time);
    }

    public function setDeliveryTo($date, $time)
    {
        $this->delivery_to = self::createDatetime($date, $time);
    }

    private static function createDatetime($date, $time)
    {
        return Carbon::createFromFormat(self::DATE_FORMAT . self::TIME_FORMAT, $date . $time);
    }

    public static function findByCurriculumId($id)
    {
        return self::where('curriculums_id', $id)->get();
    }

}
