<?php

namespace App\Http\Controllers\Admin;

use App\Handlers\Upload;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function __construct()
    {

        $this->middleware('admin.auth');
    }
    //文件上传
    public function upload(Request $request){
        $upload=new Upload();
        $upload->setInfo($request->file('file'));
        $file=$request->file('file');
         if ($upload->uploadImage()===true){
            return response()->json(['code'=>1,'msg'=>'上传成功','src'=>$upload->getUrl()]);

        };
       return response()->json(['code'=>0,'msg'=>$upload->error,'data'=>'']);

          }
          public function json($data=[],$msg='',$code=200){
         return response()->json(['code'=>$code,'msg'=>'成功','data'=>$data]);
          }


}
