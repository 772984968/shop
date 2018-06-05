<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

    protected  $fillable=['user_id','idiom_id','level_id'];
    //关联用户
    public function user(){
        return $this->belongsTo(User::class);
    }
    //关联等级
    public function level(){
    return $this->belongsTo(Level::class)->select('id','level');
    }
    //关联成语
    public function idiom(){
       return $this->belongsTo(Idiom::class)->select('id','name');
    }

}
