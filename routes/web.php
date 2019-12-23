<?php

Route::get("/", "HomeController@index")->name("home");
Route::get("/about_us", "HomeController@about_us")->name("about_us");
Route::get("/wizard", "HomeController@wizard")->name("wizard");
Route::get("/templates", "HomeController@templates")->name("templates");
Route::get("/contact_us", "HomeController@contact_us")->name("contact_us");
Route::post("/contact_us_send", "HomeController@contact_us_send")->name("contact_us_send");
Route::get("/how_it_works", "HomeController@how_it_works")->name("how_it_works");
Route::get("/login", "HomeController@login")->name("login")->middleware("guest:client");
Route::get("/logout", "HomeController@logout")->name("logout")->middleware("auth:client");
Route::get("/register", "HomeController@register")->name("register")->middleware("guest:client");
Route::get("/policy", "HomeController@policy")->name("policy");
Route::post('sluggable', 'HomeController@sluggable')->name('sluggable');

require ("client.php");
