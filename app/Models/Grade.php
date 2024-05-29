<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Curriculum;

class Grade extends Model
{
    public function curruculum()
    {
        return $this->hasMany('App\Models\Curruculum');
    }
}
