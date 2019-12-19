<?php

// Authentication Routes...
Route::get('login', 'LoginController@showLoginForm')->name('login');
Route::post('login', 'LoginController@login');
Route::post('logout', 'LoginController@logout')->name('logout');

// Home
Route::get('/', 'HomeController@index')->name('home');

// Settings
Route::group(["prefix" => "settings", "as" => "settings."], function () {

    Route::get('/index', 'SettingsController@index')->name('index');
    Route::post('/save_role', 'SettingsController@save_role')->name('save_role');
    Route::get('/delete_role/{id?}', 'SettingsController@delete_role')->name('delete_role');
    Route::post('/update_role', 'SettingsController@update_role')->name('update_role');
    Route::post('/save_permissions', 'SettingsController@save_permissions')->name('save_permissions');
    Route::get('/payment_settings', 'SettingsController@payment_settings')->name('payment_settings');
    Route::post('/add_month', 'SettingsController@add_month')->name('add_month');
    Route::get('/remove_month/{index?}', 'SettingsController@remove_month')->name('remove_month');
    Route::post('/update_month', 'SettingsController@update_month')->name('update_month');
    Route::post('/save_settings', 'SettingsController@save_settings')->name('save_settings');
    Route::post('/save_ticket_type', 'SettingsController@save_ticket_type')->name('save_ticket_type');
    Route::get('/delete_ticket_type/{id?}', 'SettingsController@delete_ticket_type')->name('delete_ticket_type');
    Route::post('/update_ticket_type', 'SettingsController@update_ticket_type')->name('update_ticket_type');
    Route::get('/no_permissions', 'SettingsController@no_permissions')->name('no_permissions');
    Route::post('save_smtp_settings', 'SettingsController@save_smtp_settings')->name('save_smtp_settings');
    Route::post('save_yamamah_settings', 'SettingsController@save_yamamah_settings')->name('save_yamamah_settings');

});

// Users
Route::group(["prefix" => "users", "as" => "users."], function () {

    Route::get('index', 'UsersController@index')->name('index');
    Route::get('add', 'UsersController@add')->name('add');
    Route::post('save', 'UsersController@save')->name('save');
    Route::get('delete/{id?}', 'UsersController@delete')->name('delete');
    Route::get('edit/{id?}', 'UsersController@edit')->name('edit');
    Route::post('update', 'UsersController@update')->name('update');

});

// Clients
Route::group(["prefix" => "clients", "as" => "clients."], function () {

    Route::get('index', 'ClientsController@index')->name('index');
    Route::get('add', 'ClientsController@add')->name('add');
    Route::post('save', 'ClientsController@save')->name('save');
    Route::get('delete/{id?}', 'ClientsController@delete')->name('delete');
    Route::get('edit/{id?}', 'ClientsController@edit')->name('edit');
    Route::post('update', 'ClientsController@update')->name('update');
    Route::get('show/{id?}', 'ClientsController@show')->name('show');
    Route::post('employee_columns', 'ClientsController@employee_columns')->name('employee_columns');

});

// Templates
Route::group(["prefix" => "templates", "as" => "templates."], function () {

    Route::get('index', 'TemplatesController@index')->name('index');
    Route::get('get_page', 'TemplatesController@get_page')->name('get_page');
    Route::post('add_category', 'TemplatesController@add_category')->name('add_category');
    Route::post('update_category', 'TemplatesController@update_category')->name('update_category');
    Route::get('delete_category/{id?}', 'TemplatesController@delete_category')->name('delete_category');
    Route::get('add', 'TemplatesController@add')->name('add');
    Route::post('save', 'TemplatesController@save')->name('save');
    Route::post('sluggable', 'TemplatesController@sluggable')->name('sluggable');
    Route::get('edit/{id?}', 'TemplatesController@edit')->name('edit');
    Route::post('update', 'TemplatesController@update')->name('update');
    Route::get('delete/{id?}', 'TemplatesController@delete')->name('delete');

});

// Websites
Route::group(["prefix" => "websites", "as" => "websites."], function () {

    Route::get('index', 'WebsiteController@index')->name('index');
    Route::post('block', 'WebsiteController@block')->name('block');
    Route::get('unblock/{id?}', 'WebsiteController@unblock')->name('unblock');
    Route::post('website_columns', 'WebsiteController@website_columns')->name('website_columns');

});

// Documentations
Route::group(["prefix" => "documentations", "as" => "documentations."], function () {
    Route::post('/save_category', 'DocumentationsController@save_category')->name('save_category');
    Route::post('/update_category', 'DocumentationsController@update_category')->name('update_category');
    Route::get('/delete_category/{id?}', 'DocumentationsController@delete_category')->name('delete_category');

    Route::get('/index', 'DocumentationsController@index')->name('index');
    Route::get('/create', 'DocumentationsController@create')->name('create');
    Route::post('/store', 'DocumentationsController@store')->name('store');
    Route::get('/edit/{id?}', 'DocumentationsController@edit')->name('edit');
    Route::post('/update/{id?}', 'DocumentationsController@update')->name('update');
    Route::get('/destroy/{id?}', 'DocumentationsController@destroy')->name('destroy');
    Route::get('/order/{id?}/{order?}', 'DocumentationsController@order')->name('order');
});

// Images
Route::group(["prefix" => "images", "as" => "images."], function () {

    Route::get('index', 'ImagesController@index')->name('index');
    Route::post('image_save', 'ImagesController@image_save')->name('image_save');
    Route::get('image_delete/{id?}', 'ImagesController@image_delete')->name('image_delete');
    Route::post('image_update', 'ImagesController@image_update')->name('image_update');
    Route::get('categories', 'ImagesController@categories')->name('categories');
    Route::post('category_save', 'ImagesController@category_save')->name('category_save');
    Route::post('category_update', 'ImagesController@category_update')->name('category_update');
    Route::get('category_delete/{id?}', 'ImagesController@category_delete')->name('category_delete');

});

// Videos
Route::group(["prefix" => "videos", "as" => "videos."], function () {

    Route::get('index', 'VideosController@index')->name('index');
    Route::post('video_save', 'VideosController@video_save')->name('video_save');
    Route::get('video_delete/{id?}', 'VideosController@video_delete')->name('video_delete');
    Route::post('video_update', 'VideosController@video_update')->name('video_update');
    Route::get('categories', 'VideosController@categories')->name('categories');
    Route::post('category_save', 'VideosController@category_save')->name('category_save');
    Route::post('category_update', 'VideosController@category_update')->name('category_update');
    Route::get('category_delete/{id?}', 'VideosController@category_delete')->name('category_delete');

});

// Plans
Route::group(["prefix" => "plans", "as" => "plans."], function () {
    Route::get('index', 'PlansController@index')->name('index');
    Route::get('add', 'PlansController@add')->name('add');
    Route::post('save', 'PlansController@save')->name('save');
    Route::get('delete/{id?}', 'PlansController@delete')->name('delete');
    Route::get('edit/{id?}', 'PlansController@edit')->name('edit');
    Route::post('update', 'PlansController@update')->name('update');
});

// Promocodes
Route::group(["prefix" => "promocodes", "as" => "promocodes."], function () {

    Route::get('index', 'PromocodesController@index')->name('index');
    Route::post('save', 'PromocodesController@save')->name('save');
    Route::get('statistics/{id?}', 'PromocodesController@statistics')->name('statistics');
    Route::get('edit/{id?}', 'PromocodesController@edit')->name('edit');
    Route::post('update', 'PromocodesController@update')->name('update');
    Route::get('delete/{id?}', 'PromocodesController@delete')->name('delete');

});
