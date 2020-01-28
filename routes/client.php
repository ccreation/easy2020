<?php

//middleware(['language'/*, 'web'*/])
Route::group(["namespace" => "Client", 'prefix' => 'client', "as" => "client."], function () {

    // Statistics
    Route::get('/', "ClientBaseController@index")->name("home");
    Route::get('home', "ClientBaseController@index")->name("home");

    // Auth
    Route::get('register', "ClientController@register")->name("register");
    Route::post('do_register', "ClientController@do_register")->name("do_register");
    Route::get('login', "ClientController@login")->name("login");
    Route::post('do_login', "ClientController@do_login")->name("do_login");
    Route::get('logout', "ClientController@logout")->name("logout");
    Route::get('password/request', "ClientController@showLinkRequestForm")->name("password.request");
    Route::post('password/email', "ClientController@sendResetLinkEmail")->name("password.email");
    Route::get('password/reset/{token?}', 'ClientController@showResetForm')->name("password.reset");
    Route::post('password/update', 'ClientController@resetPassword')->name("password.update");

    // Users
    Route::group(["prefix" => "users", "as" => "users."], function () {

        Route::get('index', 'UsersController@index')->name('index');
        Route::get('add', 'UsersController@add')->name('add');
        Route::post('save', 'UsersController@save')->name('save');
        Route::get('edit/{id?}', 'UsersController@edit')->name('edit');
        Route::get('delete/{id?}', 'UsersController@delete')->name('delete');
        Route::post('update', 'UsersController@update')->name('update');

    });

    // Settings
    Route::group(['prefix' => 'settings', "as" => "settings."], function () {
        Route::get('index', 'SettingsController@index')->name('index');
        Route::post('save_settings1', 'SettingsController@save_settings1')->name('save_settings1');
        Route::get('remove_settings/{key?}', 'SettingsController@remove_settings')->name('remove_settings');
        Route::post('save_settings2', 'SettingsController@save_settings2')->name('save_settings2');
    });

    // Website
    Route::group(["prefix" => "websites", "as" => "websites."], function () {
        Route::get('get_page', 'WebsitesController@get_page')->name('get_page');
        Route::get('index', 'WebsitesController@index')->name('index');
        Route::get('add', 'WebsitesController@add')->name('add');
        Route::post('save', 'WebsitesController@save')->name('save');
        Route::get('step2/{id?}', 'WebsitesController@step2')->name('step2');
        Route::get('choose_template/{id}', 'WebsitesController@choose_template')->name('choose_template_by_id');
        Route::get('edit/{id?}', 'WebsitesController@edit')->name('edit');
        Route::post('update', 'WebsitesController@update')->name('update');
        Route::get('delete/{id?}', 'WebsitesController@delete')->name('delete');
        Route::get('templating/{from_id?}/{to_id?}', 'WebsitesController@templating')->name('templating');
        Route::post('sluggable', 'WebsitesController@sluggable')->name('sluggable');
        // documentations
        Route::get('documentations', "WebsitesController@documentations")->name("documentations");
        Route::post('documentations_search', "WebsitesController@documentations_search")->name("documentations_search");

        // domains
        Route::get('add_domain_step_1/{id?}', "WebsitesController@add_domain_step_1")->name("add_domain_step_1");
        Route::post('add_domain_step_2', "WebsitesController@add_domain_step_2")->name("add_domain_step_2");
        Route::post('add_domain_step_3', "WebsitesController@add_domain_step_3")->name("add_domain_step_3");
        Route::post('add_domain_step_4', "WebsitesController@add_domain_step_4")->name("add_domain_step_4");

    });

    // Templates
    Route::group(["prefix" => "templates", "as" => "websites."], function () {
        Route::get('choose_template', 'WebsitesController@choose_template')->name('choose_template');
    });

    // Payments
    Route::group(["prefix" => "payments", "as" => "payments."], function () {
        Route::post('plan_payment', 'PaymentsController@plan_payment')->name('plan_payment');
        Route::post('do_plan_payment', 'PaymentsController@do_plan_payment')->name('do_plan_payment');
        Route::get('hyperpay_plan', 'PaymentsController@hyperpay_plan')->name('hyperpay_plan');
        Route::get('template_payment/{from_id?}/{to_id?}', 'PaymentsController@template_payment')->name('template_payment');
        Route::post('do_template_payment', 'PaymentsController@do_template_payment')->name('do_template_payment');
        Route::get('hyperpay_template', 'PaymentsController@hyperpay_template')->name('hyperpay_template');
        Route::get('plugin_payment/{id?}', 'PaymentsController@plugin_payment')->name('plugin_payment');
        Route::post('do_plugin_payment', 'PaymentsController@do_plugin_payment')->name('do_plugin_payment');
        Route::get('hyperpay_plugin', 'PaymentsController@hyperpay_plugin')->name('hyperpay_plugin');
    });

    // Subscriptions
    Route::group(["prefix" => "subscriptions", "as" => "subscriptions."], function () {
        Route::get('index', 'SubscriptionsController@index')->name('index');
    });

    // Plans
    Route::group(["prefix" => "plans", "as" => "plans."], function () {
        Route::get('index', 'PlansController@index')->name('index');
        Route::get('buy/{id?}', 'PlansController@buy')->name('buy');
        Route::post('coupon', 'PlansController@coupon')->name('coupon');
        Route::get('details/{id?}', 'PlansController@details')->name('details');
    });

    // Messages
    Route::group(["prefix" => "messages", "as" => "messages."], function () {
        Route::get('index', 'MessagesController@index')->name('index');
        Route::get('preview/{id?}', 'MessagesController@preview')->name('preview');
        Route::get('delete/{id?}', 'MessagesController@delete')->name('delete');
    });

    // Messages
    Route::group(["prefix" => "newsletter", "as" => "newsletter."], function () {
        Route::get('index', 'MessagesController@newsletter_index')->name('index');
        Route::get('newsletter_export_excel', 'MessagesController@newsletter_export_excel')->name('newsletter_export_excel');
    });

    // Tickets
    Route::group(["prefix" => "tickets", "as" => "tickets."], function () {

        Route::get('index', 'TicketsController@index')->name('index');
        Route::get('add', 'TicketsController@add')->name('add');
        Route::post('send', 'TicketsController@send')->name('send');
        Route::get('edit/{id?}', 'TicketsController@edit')->name('edit');
        Route::get('download_attachement/{id?}/{num?}', 'TicketsController@download_attachement')->name('download_attachement');
        Route::get('show/{id?}', 'TicketsController@show')->name('show');
        Route::post('update', 'TicketsController@update')->name('update');
        Route::get('delete/{id?}', 'TicketsController@delete')->name('delete');
        Route::post('status', 'TicketsController@status')->name('status');
        Route::post('reply', 'TicketsController@reply')->name('reply');

    });

    // Notifications
    Route::group(["prefix" => "notifications", "as" => "notifications."], function () {

        Route::get('index', 'NotificationsController@index')->name('index');

    });

    // Roles and permissions
    Route::group(['prefix' => 'settings', "as" => "settings."], function () {

        Route::get('permissions', "SettingsController@permissions")->name("permissions");
        Route::post('save_role', "SettingsController@save_role")->name("save_role");
        Route::post('update_role', "SettingsController@update_role")->name("update_role");
        Route::get('delete_role/{id?}', "SettingsController@delete_role")->name("delete_role");
        Route::post('save_permissions', "SettingsController@save_permissions")->name("save_permissions");
        Route::get('no_permissions', "SettingsController@no_permissions")->name("no_permissions");

    });

    // Plugin
    Route::group(["prefix" => "plugins", "as" => "plugins."], function () {
        Route::get('index', 'PluginsController@index')->name('index');
        Route::get('settings/{id?}', 'PluginsController@settings')->name('settings');
        Route::post('save_app', 'PluginsController@save_app')->name('save_app');
        Route::get('show_app_field/{id?}', 'PluginsController@show_app_field')->name('show_app_field');
        Route::get('edit_app/{id?}', 'PluginsController@edit_app')->name('edit_app');
        Route::get('remove_app/{id?}', 'PluginsController@remove_app')->name('remove_app');
        Route::post('update_app', 'PluginsController@update_app')->name('update_app');
        Route::post('save_app_field', 'PluginsController@save_app_field')->name('save_app_field');
        Route::post('remove_app_field', 'PluginsController@remove_app_field')->name('remove_app_field');
        Route::get('reorder_form_fields/{id?}/{order?}', 'PluginsController@reorder_form_fields')->name('reorder_form_fields');
        Route::post('duplicate_app_field', 'PluginsController@duplicate_app_field')->name('duplicate_app_field');
        Route::get('app_data/{id?}', 'PluginsController@app_data')->name('app_data');
        Route::get('remove_app_data/{id?}', 'PluginsController@remove_app_data')->name('remove_app_data');
        Route::post('save_settings1', 'PluginsController@save_settings1')->name('save_settings1');
        Route::post('save_settings2', 'PluginsController@save_settings2')->name('save_settings2');
        Route::post('save_settings5', 'PluginsController@save_settings5')->name('save_settings5');
        Route::post('save_settings6', 'PluginsController@save_settings6')->name('save_settings6');
        Route::post('save_settings7', 'PluginsController@save_settings7')->name('save_settings7');
        Route::post('export_to_mailchimp', 'PluginsController@export_to_mailchimp')->name('export_to_mailchimp');
        Route::get('export_excel/{id?}', 'PluginsController@export_excel')->name('export_excel');

        Route::post('save_plugin_data', 'PluginsController@save_plugin_data')->name('save_plugin_data');
        Route::post('update_plugin_data', 'PluginsController@update_plugin_data')->name('update_plugin_data');
        Route::get('delete_plugin_data/{id?}', 'PluginsController@delete_plugin_data')->name('delete_plugin_data');

    });

    // Comments
    Route::group(["prefix" => "comments", "as" => "comments."], function () {

        Route::get('comments', 'WebsitesController@comments')->name('comments');
        Route::get('change_comment_status/{id?}/{status?}', 'WebsitesController@change_comment_status')->name('change_comment_status');
        Route::get('delete_comment/{id?}', 'WebsitesController@delete_comment')->name('delete_comment');
        Route::post('update_comment', 'WebsitesController@update_comment')->name('update_comment');

    });

    // Members
    Route::group(["prefix" => "members", "as" => "members."], function () {
        Route::get('index', 'MembersController@index')->name('index');
        Route::get('add', 'MembersController@add')->name('add');
        Route::post('store', 'MembersController@store')->name('store');
        Route::get('deactivate/{id?}', 'MembersController@deactivate')->name('deactivate');
        Route::get('activate/{id?}', 'MembersController@activate')->name('activate');
        Route::get('edit/{id?}', 'MembersController@edit')->name('edit');
        Route::post('update', 'MembersController@update')->name('update');
        Route::get('delete/{id?}', 'MembersController@delete')->name('delete');
    });

    /*Route::get('hyperpay', "ClientBaseController@hyperpay");
    Route::get('hyperpay_redirect', "ClientBaseController@hyperpay_redirect")->name("hyperpay_redirect");

    Route::get('locale/{locale}', "ClientBaseController@locale");


    Route::get('statistics', "ClientBaseController@statistics")->name("statistics");


























// First time add website
    Route::get('categories', "WebsitesController@categories")->name("categories");
    Route::get('category/{id?}', "WebsitesController@category")->name("category");






    */

});
