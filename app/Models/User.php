<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Grade;

class User extends Model
{
    public function grade()
    {
        return $this->belongsTo('App\Models\Grade');
    }
}
