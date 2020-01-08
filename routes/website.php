<?php

//home
Route::get('/', 'WebsiteController@index')->name('index');
Route::get('/{id?}', 'WebsiteController@page')->name('page');
Route::post('/save_custom_form', 'WebsiteController@save_custom_form')->name('save_custom_form');
//SetLocal
Route::get('/setLocal/{local?}', 'WebsiteController@setLocal')->name('setLocal');
