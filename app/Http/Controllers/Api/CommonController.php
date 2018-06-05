<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Models\Idiom;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CommonController extends AuthController
{
    public function __construct()
    {
        parent::__construct();
    }
    //意见反馈
    public function feedback(Request $request){
       $data= $this->checkValidate($request,[
            'user_id'=>'required',
            'content'=>'required|min:8',
        ]);
        if (Feedback::create($data)){
            return $this->arrayResponse();
        }else{
            return $this->response()->errorInternal('系统错误，请稍后重试');
        };
    }
    //课堂首页
    public function classroom(){
            $levels=Level::select('id','level')->get();
            $data=[];
            $levels->each(function($itme,$key){
                $itme->count=Idiom::where('level_id',$itme->id)->count();
            });
            if ($levels){
                return $this->arrayResponse('success',200,$levels);
            }

    }
    //搜索成语
    public function search(Request $request){
       $this->checkValidate($request,[
           'idiom'=>'required'
       ]);
       $name=$request->idiom;
       $rs=Idiom::where('name','like',"%$name%")->with('level')->select('id','name','level_id')->limit(5)->get();
       if ($rs){
           return $this->arrayResponse('success','200',$rs);
       }else{
           return $this->response()->errorNotFound('未找到该成语');
       }
    }

}
