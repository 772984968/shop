<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerImages extends Model
{
    protected $fillable = ['title','link','sort','image','banner_id'];
}
