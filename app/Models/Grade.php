<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Curriculum;

class Grade extends Model
{
    private const ELEMENTARY_SCHOOL_IDS = [ 1, 2, 3, 4, 5, 6, ];
    private const JUNIOR_HIGH_SCHOOL_IDS = [ 7, 8, 9, ];
    private const HIGH_SCHOOL_IDS = [ 10, 11, 12, ];

    public function curruculum()
    {
        return $this->hasMany('App\Models\Curruculum');
    }

    /**
     * idに応じて、学校の区分を返すメソッド
     * 色分けに利用する
     * idは小学校1年生から高校３年生へ、昇順になっている必要がある
    */
    public function getDivision()
    {
        if (in_array($this->id, self::ELEMENTARY_SCHOOL_IDS)) {
            return 'elementary';
        } else if (in_array($this->id, self::JUNIOR_HIGH_SCHOOL_IDS)) {
            return 'junior-high';
        } else if (in_array($this->id, self::HIGH_SCHOOL_IDS)) {
            return 'high';
        }
        return 'error';
    }
}
