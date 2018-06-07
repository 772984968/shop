<?php
Route::any('category/getData','CategoryController@getData')->name('category.getData');
Route::get('category/detail','CategoryController@detail')->name('category.detail');
Route::resource('category','CategoryController');
