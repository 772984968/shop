<?php
//意见反馈
$api->post('feedback','CommonController@feedback')->name('Common.feedback');
//课堂
$api->get('classroom','CommonController@classroom')->name('Common.classroom');
//成语搜索
$api->get('search','CommonController@search')->name('Common.search');
