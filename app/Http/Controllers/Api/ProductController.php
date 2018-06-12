<?php

namespace App\Http\Controllers\Api;

use App\Models\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends BaseController
{
    //最新商品
    public function is_new(Request $request){
        $limit=$request->input('limit')??10;
        $goods=Goods::where('is_new',1)->with('images')->paginate($limit);
        return $this->arrayResponse($goods);
    }
    //推荐商品
    public function is_hot(Request $request){
        $limit=$request->input('limit')??10;
        $goods=Goods::where('is_hot',1)->with('images')->paginate($limit);
        return $this->arrayResponse($goods);
    }
}
