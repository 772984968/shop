<?php
//用户登陆
$api->post('login','UserController@login')->name('user.login');
// 小程序登录
$api->post('login/authorizations', 'UserController@weappStore')->name('weappStore');
//权限验证
$api->group(['middleware' => 'auth:api'], function ($api) {
    //用户首页
    $api->get('index','UserController@index');
    //用户登出
    $api->get('logout','UserController@logout');
    //刷新令牌
    $api->get('refresh','UserController@refresh');
    //个人中心
    $api->get('personal','UserController@personal');
    //绑定信息
    $api->post('setInfo','UserController@setInfo');

    //收藏管理
    $api->resource('collection','CollectionController');

   //地址管理
    $api->resource('address','AddressController');


    //添加成语近义词，反义词
    $api->get('idiom',"UserController@idiom");

});
