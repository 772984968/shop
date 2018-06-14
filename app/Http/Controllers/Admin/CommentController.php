<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends TemplateController
{
    protected $model;
    public $config = [
        "title" => '评论管理',
        'index' => 'comment.index',//首页
      //  'create' => 'comment.create',//创建
        'store' => 'comment.store',//创建保存
        'show' => 'comment.show',//查看
      //  'edit' => 'comment.edit',//编辑
        'update' => 'comment.update',//编辑保存
        'delete' => 'comment.destroy',//删除
    ];

    public function __construct(Comment $comment)
    {
        $this->model = $comment;

    }
    public function index(Request $request)
    {
        if ($request->ajax()){
            return response()->json($this->getData($request));
        }


        $data['title'] = $this->getTitle();// 标题
        $data['config'] = $this->config;//获取配置
        return view('admin.'.$this->config['index'], compact('data'));
    }
    function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'user_id', 'title' => '用户','templet'=>'#userTpl'],
            ['field' => 'goods_id', 'title' => '商品','templet'=>'#goodsTpl'],
            ['field' => 'order_id', 'title' => '订单','templet'=>'#orderTpl'],
            ['field' => 'content', 'title' => '内容', 'sort' => 'true','width'=>700],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];

    }
    //获取数据
    public function getData($request){
        $model= $this->model;
        $limit=$request->limit??'10';
        $count=$model->count();
        $paginate=$model->with('user','goods')->paginate($limit);
        $data=$paginate->toArray();
        return  $data=['code'=>0,'msg'=>'','count'=>$count,'data'=>$data['data']];
    }
    public function show($id)
    {
        $model=$this->model::with('images')->find($id);
        $config = $this->config;//获取配置
        return view('admin.'.''.$this->config['show'],compact('model','config'));
    }


}
