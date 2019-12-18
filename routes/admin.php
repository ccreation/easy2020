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
