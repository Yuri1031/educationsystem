<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Banners;

class Banners extends Model
{
    use HasFactory;

    public function getBannerImages(){
        $banners = Banner::all();
        return $banners;
    }
    
}

