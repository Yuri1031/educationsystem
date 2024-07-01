<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTimes extends Model
{
    use HasFactory;

    protected $table = 'delivery_times';

    public function curriculum()
    {
        return $this->belongsTo(Curriculums::class, 'curriculum_id');
    }
}


