<?php

namespace App\Http\Controllers\Api;
use App\Models\Idiom;
use App\Models\Collection;
use Illuminate\Http\Request;
class CollectionController extends AuthController
{
    protected $model;
    public function __construct()
    {
        $this->model=new Collection();

    }

    //收藏列表
    public function collection(){
        $user=auth('api')->user();
        $colletcs=Collection::where('user_id',$user->id)->with('level','idiom')->get();
        if ($colletcs)
        {
            return $this->arrayResponse('success','200',$colletcs);
        }
    }
    //添加收藏
    public function setCollection(Request $request){
        $data=$this->checkValidate($request,[
            'idiom_id'=>'required|exists:idioms,id',
        ],[
            'idiom_id.exists'=>'没有该成语信息',

        ]);
        $model=Collection::where(['user_id'=>auth('api')->id(),'idiom_id'=>$data['idiom_id']])->first();
        if ($model){
          $this->response()->error("该成语已在收藏列表中",402);
        }
        $this->model->idiom_id=$data['idiom_id'];
        $this->model->user_id=auth('api')->id();
        $this->model->level_id=Idiom::getLevelId($data['idiom_id']);
        if ($this->model->save()){
         return   $this->arrayResponse();
        }else{
            return$this->response()->errorInternal('系统错误，请重试');
        };
    }
    //添加收藏
    public function delCollection(Request $request){

        $data=$this->checkValidate($request,[
            'idiom_id'=>'required|exists:idioms,id',
        ],[
            'idiom_id.exists'=>'没有该成语信息',

        ]);
        $model=Collection::where(['user_id'=>auth('api')->id(),'idiom_id'=>$data['idiom_id']])->first();
        if (!$model){
            $this->response()->error("该成语不在收藏列表中",402);
        }
        if ($model->delete()){
            return   $this->arrayResponse();
        }else{
            return$this->response()->errorInternal('系统错误，请重试');
        };
    }

}
