@extends('admin.layouts.admin')
@section('_meta')
    @include('admin.layouts._meta')
    <link href="{{asset('admin/plugins/layui/css/layui.css')}}" rel="stylesheet" xmlns="http://www.w3.org/1999/html">
@endsection
@section('title', '后台管理')
@section('content')
    <body>
    <div class="layui-container"layui-bg-gray>
        <fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">

        </fieldset>
             {{ csrf_field() }}

        <form class="layui-form layui-form-pane" action="">
            <div class="layui-form-item">
                <label class="layui-form-label">商品名称</label>
                <div class="layui-input-block">
                    <input type="text" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$goods->goods_name}}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">所属品牌</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="" autocomplete="off" class="layui-input"  value="{{$goods->brand_id}}">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">所属类型</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="" autocomplete="off" class="layui-input"  value="{{$goods->category_id}}">
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">商品库存</label>
                    <div class="layui-input-block">
                        <input type="text" name="date" id="date1" autocomplete="off" class="layui-input"  value="{{$goods->goods_number}}">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">商品销量</label>
                    <div class="layui-input-inline">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="{{$goods->sales_sum}}">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-inline">
                    <label class="layui-form-label">本店价格</label>
                    <div class="layui-input-block">
                        <input type="text" name="date" id="date1" autocomplete="off" class="layui-input"  value="{{$goods->shop_price}}">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">商场价格</label>
                    <div class="layui-input-inline">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="{{$goods->market_price}}">
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">促销价格</label>
                    <div class="layui-input-inline">
                        <input type="text" name="number" autocomplete="off" class="layui-input" value="{{$goods->promote_price}}">
                    </div>
                </div>
            </div>

            <div class="layui-form-item" >
                <div class="layui-inline">
                    <label class="layui-form-label">是否新品</label>
                    <div class="layui-input-inline">
                        <input type="checkbox" checked="" lay-text="是|否" name="open" lay-skin="switch" lay-filter="switchTest" title="开关" disabled>                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">是否促销</label>
                    <div class="layui-input-inline">
                        <input type="checkbox" checked="" lay-text="是|否" name="open" lay-skin="switch" lay-filter="switchTest" title="开关" disabled>
                    </div>
                </div>
                <div class="layui-inline">
                    <label class="layui-form-label">特价促销</label>
                    <div class="layui-input-inline">
                        <input type="checkbox" checked="" lay-text="是|否" name="open" lay-skin="switch" lay-filter="switchTest" title="开关" disabled>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">排序</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input"  value="{{$goods->sort}}" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">是否上架</label>
                <div class="layui-input-inline">
                    <input type="checkbox" checked="" lay-text="是|否" name="open" lay-skin="switch" lay-filter="switchTest" title="开关" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">创建时间</label>
                <div class="layui-input-inline">
                    <input type="text" name="username" lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input"  value="{{$goods->created_at}}" disabled>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品略缩图</label>
                <div class="layui-input-block">
                    <img src="{{$goods->goods_thumb}}" with="150" height="150">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">商品简短描述</label>
                <div class="layui-input-block">
                    <input type="text" autocomplete="off" placeholder="请输入标题" class="layui-input" value="{{$goods->goods_brief}}">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">商品详细描述</label>
                <div class="layui-input-block">
                    <textarea  class="layui-textarea">{{$goods->goods_desc}}</textarea>
                </div>
            </div>
        </form>
      </div>
    </body>
    @endsection
    @section('script')
        @include('admin.layouts._script')
        <script src="{{asset('admin/plugins/layui/layui.all.js')}}"></script>
    @stop

