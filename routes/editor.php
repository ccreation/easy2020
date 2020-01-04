<?php

// Editor
Route::group(["namespace" => "Common", 'prefix' => 'editor/', "as"=>"editor."], function (){

    Route::get('edit/{id?}/{page_id?}/', 'EditorController@edit')->name('edit');
    Route::post('save_page', 'EditorController@save_page')->name('save_page');
    Route::get('delete_page/{page_id?}', 'EditorController@delete_page')->name('delete_page');
    Route::post('update_page', 'EditorController@update_page')->name('update_page');
    Route::post('update_slug', 'EditorController@update_slug')->name('update_slug');
    Route::post('save_page_html_content', 'EditorController@save_page_html_content')->name('save_page_html_content');

});
