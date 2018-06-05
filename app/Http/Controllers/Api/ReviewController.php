<?php

namespace App\Http\Controllers\Api;
use App\Models\Idiom;
use App\Models\Review;
use Illuminate\Http\Request;
class ReviewController extends AuthController
{
    //回顾列表
    public function review(){
        $user=auth('api')->user();
        if ($user->review){
            $idiom_ids=explode(',',$user->review->idiom_ids);
            $rs=Idiom::select('id','name')->findMany($idiom_ids);
            return $this->arrayResponse('success','200',$rs);
        }
        return $this->arrayResponse();
    }
    //添加回顾
    public function setReview(Request $request){
        $data=$this->checkValidate($request,[
            'idiom_id'=>'required'
        ]);
        $re=Review::where('user_id',auth('api')->id())->first();

        if (in_array($data['idiom_id'],explode(',',$re->idiom_ids))){
          $this->response()->error("该成语已在列表中",402);
        }
        $re->idiom_ids=$re->idiom_ids.','.$data['idiom_id'];
        if ($re->save()){
         return   $this->arrayResponse();
        }else{
            return$this->response()->errorInternal('系统错误，请重试');
        };


    }

    //回顾详情
    public function reviewDetial(Request $request){

        $data=$this->checkValidate($request,[
            'idiom_id'=>'required',
        ]);
        $re=Review::where('user_id',auth('api')->id())->first();
        if (!in_array($data['idiom_id'],explode(',',$re->idiom_ids))){
            $this->response()->error("还未学习过该成语",402);
        }
        $idiom=Idiom::with('level')->find($data['idiom_id']);
        if ($idiom){
            if ($idiom->level){
                $idiom->level->count=Idiom::getCount($idiom->level_id);
            }

            return   $this->arrayResponse('success','200',$idiom);
        }else{
            return$this->response()->errorInternal('系统错误，请重试');
        };




    }
}
