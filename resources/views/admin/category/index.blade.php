@extends('admin.layouts.admin')
{{--meta、css--}}
@section('_meta')
    @include('admin.layouts._meta')
    <link href="{{asset('admin/plugins/layui/css/layui.css')}}" rel="stylesheet">
@endsection
{{--title--}}
@section('title', '后台管理系统')
{{--coentent 主题内容--}}
@section('content')
    <body>
     <div class="col-sm-3">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>默认</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                     <a class="close-link">
                        <i class="fa fa-times"></i>
                    </a>
                </div>
            </div>
            <div class="ibox-content" style="display: block;">
                <div style="display: inline-block;overflow: auto;">
                    <ul id="demo1">
                    </ul>
                </div>
            </div>
        </div>
    </div>
     <div class="col-sm-9">
         <div class="ibox float-e-margins">
             <div class="ibox-title">
                 <h5></h5>
                 <div class="ibox-tools">
                     <a class="collapse-link">
                         <i class="fa fa-chevron-up"></i>
                     </a>
                     <a class="close-link">
                         <i class="fa fa-times"></i>
                     </a>
                 </div>
             </div>
             <div class="ibox-content" style="display: block;">
                 <iframe class="J_iframe" name="iframe0" width="100%" height="800px;" src="{{route('category.show',[':id'])}}" frameborder="0" data-id="" seamless></iframe>
             </div>
         </div>
     </div>



    </body>
@endsection
{{--script 代码和js--}}
@section('script')

    @include('admin.layouts._script')
    <script src="{{asset('admin/plugins/layui/layui.all.js')}}"></script>
    <script>
        //Demo
        layui.use(['tree', 'layer'], function(){
            var layer = layui.layer
                ,$ = layui.jquery;

            layui.tree({
                elem: '#demo1' //指定元素
                ,target: '_blank' //是否新选项卡打开（比如节点返回href才有效）
                ,skin: 'shihuang'
                ,click: function(item){ //点击节点回调
                    layer.msg('当前节名称：'+ item.name + '<br>全部参数：'+ JSON.stringify(item));
                    console.log(item);
                }
                ,nodes: [ //节点
                    {
                        name: '常用文件夹'
                        ,id: 1
                        ,alias: 'changyong'
                        ,children: [
                            {
                                name: '所有未读（设置跳转）'
                                ,id: 11
                                ,href: 'http://www.layui.com/'
                                ,alias: 'weidu'
                            }, {
                                name: '置顶邮件'
                                ,id: 12
                            }, {
                                name: '标签邮件'
                                ,id: 13
                            }
                        ]
                    }, {
                        name: '我的邮箱'
                        ,id: 2
                        ,children: [
                            {
                                name: 'QQ邮箱'
                                ,id: 21
                                ,spread: true
                                ,children: [
                                    {
                                        name: '收件箱'
                                        ,id: 211
                                        ,children: [
                                            {
                                                name: '所有未读'
                                                ,id: 2111
                                            }, {
                                                name: '置顶邮件'
                                                ,id: 2112
                                            }, {
                                                name: '标签邮件'
                                                ,id: 2113
                                            }
                                        ]
                                    }, {
                                        name: '已发出的邮件'
                                        ,id: 212
                                    }, {
                                        name: '垃圾邮件'
                                        ,id: 213
                                    }
                                ]
                            }, {
                                name: '阿里云邮'
                                ,id: 22
                                ,children: [
                                    {
                                        name: '收件箱'
                                        ,id: 221
                                    }, {
                                        name: '已发出的邮件'
                                        ,id: 222
                                    }, {
                                        name: '垃圾邮件'
                                        ,id: 223
                                    }
                                ]
                            }
                        ]
                    }
                    ,{
                        name: '收藏夹'
                        ,id: 3
                        ,alias: 'changyong'
                        ,children: [
                            {
                                name: '爱情动作片'
                                ,id: 31
                                ,alias: 'love'
                            }, {
                                name: '技术栈'
                                ,id: 12
                                ,children: [
                                    {
                                        name: '前端'
                                        ,id: 121
                                    }
                                    ,{
                                        name: '全端'
                                        ,id: 122
                                    }
                                ]
                            }
                        ]
                    }
                ]
            });

        });
    </script>
@stop