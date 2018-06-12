<?php
Route::any('product/getData','ProductController@getData')->name('product.getData');
Route::get('product/detail','ProductController@detail')->name('product.detail');
Route::post('product/delImage','ProductController@delImage')->name('product.delImage');
Route::resource('product','ProductController');
