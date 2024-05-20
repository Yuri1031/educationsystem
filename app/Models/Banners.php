<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Banners;

class Banners extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'created_at', 'updated_at'];
        
}

