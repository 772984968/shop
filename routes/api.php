<?php
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', function ($api) {
    $api->group(['namespace'=>'App\Http\Controllers\Api'],function($api){

        //公共接口
        require_once __DIR__.'/api/common.php';

        //用户管理
        $api->group(['prefix'=>'user'],function($api){
            require_once __DIR__.'/api/user.php';
        });

        //成语管理
        $api->group(['prefix'=>'idiom','middleware' => 'auth:api'],function($api){
            require_once __DIR__.'/api/idiom.php';
        });
        //回顾管理
        $api->group(['prefix'=>'review'],function($api){
            require_once __DIR__.'/api/review.php';
        });
        //权限验证
        $api->group(['middleware' => 'auth:api'], function ($api) {
         });
    });
 });
