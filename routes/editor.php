<?php

// Editor
Route::group(["namespace" => "Common", 'prefix' => 'editor/', "as"=>"editor."], function (){

    Route::get('edit/{id?}/{page_id?}/', 'EditorController@edit')->name('edit');
    Route::post('save_page', 'EditorController@save_page')->name('save_page');
    Route::get('delete_page/{page_id?}', 'EditorController@delete_page')->name('delete_page');
    Route::post('update_page', 'EditorController@update_page')->name('update_page');
    Route::post('update_slug', 'EditorController@update_slug')->name('update_slug');
    Route::post('save_page_html_content', 'EditorController@save_page_html_content')->name('save_page_html_content');
    Route::post('get_custom_form', 'EditorController@get_custom_form')->name('get_custom_form');
    Route::post('images_upload_save', 'EditorController@images_upload_save')->name('images_upload_save');
    Route::post('images_upload_delete', 'EditorController@images_upload_delete')->name('images_upload_delete');
    Route::post('videos_upload_save', 'EditorController@videos_upload_save')->name('videos_upload_save');
    Route::post('videos_upload_delete', 'EditorController@videos_upload_delete')->name('videos_upload_delete');
    Route::post('change_font', 'EditorController@change_font')->name('change_font');
    Route::post('save_color', 'EditorController@save_color')->name('save_color');
    Route::post('change_color_default', 'EditorController@change_color_default')->name('change_color_default');
    Route::post('update_color', 'EditorController@update_color')->name('update_color');
    Route::post('remove_color', 'EditorController@remove_color')->name('remove_color');

});
