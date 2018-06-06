<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{

    public function run()
    {
        $categories = [
            [
                'category_name'        => '手机数码',

            ],
            [
                'category_name'        => '服装服饰',

            ],
            [
                'category_name'        => '电脑配件',

            ],
            [
                'category_name'        => '家具家居',

            ],
            [
                'category_name'=>'鞋类配饰',
            ]
        ];
       \App\Models\Category::insert($categories);
       $this->level2();
       $this->level3();
    }
    public function level2(){
        $level2=[
            ['手机通讯','手机配件','电子配件']
            ,['女装','男装','配饰']
            ,['游戏设备','网络产品','电脑设备']
            ,['生活日品','家纺','厨具']
            ,['男鞋','女鞋','儿童鞋']];

            foreach ($level2 as $key=>$value){
                foreach ($value as $vo){
                    Category::create([
                        'parent_id'=>$key+1,
                        'category_name'=>$vo,
                        'level'=>1,
                    ]);
                }

            }
   } public function level3(){
    $level3=[['手机','老人手机']
        ,['耳机','贴膜']
        ,['电池','存储卡',]
        ,['裙子','衣服']
        ,['裤子','上衣',]
        ,['耳环','背包',]
        ,['游戏周边','游戏软件',]
        ,['网线','路由器']
        ,['鼠标','键盘']
        ,['纸巾','洗发水']
        ,['被子','床垫']
        ,['煤气','洗碗机']
        ,['波鞋','皮鞋']
        ,['皮鞋','高跟鞋']
        ,['小鞋','宝宝鞋']
    ];

    foreach ($level3 as $value){
         static $key=6;
        foreach ($value as $vo){
            Category::create([
                'parent_id'=>$key++,
                'category_name'=>$vo,
                'level'=>2,
            ]);
        }

    }
}

}
