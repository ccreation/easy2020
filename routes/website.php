<?php

//home
Route::get('/', 'WebsiteController@index')->name('index');
Route::get('/{id?}', 'WebsiteController@page')->name('page');

//SetLocal
Route::get('/setLocal/{local?}', 'WebsiteController@setLocal')->name('setLocal');
