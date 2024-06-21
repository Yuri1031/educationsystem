<?php

namespace App\Models;

use DateTime;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

    // delivery_fromを取り出すときは、DateTimeとしてとりだす。
    public function getDeliveryFromAttribute($value)
    {
        return new DateTime($value);
    }

    // delivery_toを取り出すときは、DateTimeとしてとりだす。
    public function getDeliveryToAttribute($value)
    {
        return new DateTime($value);
    }

    // delivery_fromのDate部分をフォーマットにしたがって取り出す
    public function getDeliveryDateFrom() {
        return $this->delivery_from->format(self::DATE_FORMAT);
    }

    // delivery_toのDate部分をフォーマットにしたがって取り出す
    public function getDeliveryDateTo()
    {
        return $this->delivery_to->format(self::DATE_FORMAT);
    }

    // delivery_fromのTime部分をフォーマットにしたがって取り出す
    public function getDeliveryTimeFrom()
    {
        return $this->delivery_from->format(self::TIME_FORMAT);
    }

    // delivery_toのTime部分をフォーマットにしたがって取り出す
    public function getDeliveryTimeTo()
    {
        return $this->delivery_to->format(self::TIME_FORMAT);
    }

    // フォーマットに従った文字列を、DateTimeに直してdelivery_fromに格納する
    public function setDeliveryFrom($date, $time)
    {
        $this->delivery_from = self::createDatetime($date, $time);
    }

    // フォーマットに従った文字列を、DateTimeに直してdelivery_toに格納する
    public function setDeliveryTo($date, $time)
    {
        $this->delivery_to = self::createDatetime($date, $time);
    }

    // フォーマットに従った文字列を、DateTimeに直す処理
    private static function createDatetime($date, $time)
    {
        return Carbon::createFromFormat(self::DATE_FORMAT . self::TIME_FORMAT, $date . $time);
    }

    // あるcurriculums_idを持つDeliveryTimeを全て取得する
    public static function findByCurriculumId($id, $ordered = false, $by = 'delivery_from',  $asc = true)
    {
        $builder = self::where('curriculums_id', $id);
        if ($ordered) {
            if (!($by == 'delivery_from' || $by == 'delivery_to')) {
                throw new InvalidArgumentException("Argument $by must be 'delivery_from' or 'delivery_to'");
            }
            $asc_or_desc = $asc ? 'asc' : 'desc';
            $builder->orderBy($by, $asc_or_desc);
        }
        return $builder->get();
    }

}
