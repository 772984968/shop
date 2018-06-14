<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable=['goods_id','order_id','content','goods_rank','hidden','user_id'];
    public function goods(){
        return $this->belongsTo(Goods::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function images(){
        return $this->hasMany(CommentImage::class);
    }

}
