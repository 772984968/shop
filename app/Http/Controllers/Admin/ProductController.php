<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\ProductForm;
use App\Models\Category;
use App\Models\Goods;
use App\Models\GoodsImages;
use Illuminate\Http\Request;


class ProductController extends TemplateController
{
    protected $model;
    public $config = [
        "title" => '产品管理',
        'index' => 'product.index',//首页
        'create' => 'product.create',//创建
        'store' => 'product.store',//创建保存
        'show' => 'product.show',//查看
        'edit' => 'product.edit',//编辑
        'update' => 'product.update',//编辑保存
        'delete' => 'product.destroy',//删除
    ];

    public function __construct(Goods $goods)
    {
        $this->model = $goods;

    }

    public function store(ProductForm $request)
    {
        $faker = app(\Faker\Generator::class);
        $model = $this->model;
        $data=array_filter($request->all());
        if (isset($data['qu'])){
                  $data['category_id']=$data['qu'];
        }
        elseif (isset($data['shi'])){
            $data['category_id']=$data['shi'];
        }
        else{
            $data['category_id']=$data['sheng'];
        }

        $model->fill($data);
        $model->goods_sn=$faker->uuid;
          if ($model->save()) {
              if (isset($data['images'])){
                  GoodsImages::setImage($model->id,$data['images']);
              }
            return response()->json(['code' => 200, 'msg' => '添加成功']);
        } else {
            return response()->json(['code' => 400, 'msg' => '添加失败']);
        }


    }
    public function update(ProductForm $request, $id)
    {

        $model = Goods::find($id);
        $model->is_hot=0;
        $model->is_new=0;
        $model->is_promote=0;
        $model->is_on_sale=0;
        $data=array_filter($request->all());
        if (isset($data['qu'])){
            $data['category_id']=$data['qu'];
        }
        elseif (isset($data['shi'])){
            $data['category_id']=$data['shi'];
        }
        else{
            $data['category_id']=$data['sheng'];
        }

        $model->fill($data);
        if ($model->save()) {
            if (isset($data['images'])){
                GoodsImages::setImage($model->id,$data['images']);
            }
            return response()->json(['code' => 200, 'msg' => '修改成功']);
        } else {
            return response()->json(['code' => 400, 'msg' => '修改失败']);
        }


    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->getData($request));
        }
        $data['title'] = $this->getTitle();// 标题
        $data['config'] = $this->config;//获取配置
        return view('admin.product.index', ['data' => $data]);

    }

    //表格标题
    function getTitle()
    {
        return [[
            ['type' => 'checkbox'],
            ['field' => 'id', 'title' => 'ID', 'sort' => 'true'],
            ['field' => 'category_id', 'title' => '所属分类'],
            ['field' => 'goods_thumb', 'title' => '商品货号'],
            ['field' => 'goods_name', 'title' => '商品名称'],
            ['field' => 'goods_number', 'title' => '商品库存', 'sort' => 'true'],
            ['field' => 'market_price', 'title' => '市场售价', 'sort' => 'true'],
            ['field' => 'shop_price', 'title' => '本店价格', 'sort' => 'true'],
            ['field' => 'promote_price', 'title' => '促销价格', 'sort' => 'true'],
            ['field' => 'is_no_sale', 'title' => '是否上架'],
            ['field' => 'sales_sum', 'title' => '销售数量', 'sort' => 'true'],
            ['field' => 'right', 'title' => '数据操作', 'align' => 'center', 'toolbar' => '#barDemo', 'width' => 300]
        ]];

    }

    public function show($id)
    {
        $goods = Goods::find($id);

        return view('admin.product.show', compact('goods'));

    }
    //展示创建页
    public function create(){
        $config = $this->config;//获取配置
        $category=Category::getSonCategory('pid');
        return view('admin.'.$this->config['create'],compact('config','category'));
    }
    //展示编辑页
    public function edit($id){
        $model=$this->model::with('images')->find($id);
        $config = $this->config;//获取配置

        //获取类型
        $category=Category::defaultOrder()->ancestorsAndSelf($model->category_id);
        $node=Category::getSonCategory('pid');
        return view('admin.'.''.$this->config['edit'],compact('model','config','category','node'));
    }

    //删除产品图片
    public function delImage(Request $request){
        $id=$request->input('id');
        if (GoodsImages::destroy($id)){
            return $this->json();
        }

    }
}
