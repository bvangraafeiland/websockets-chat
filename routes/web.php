<?php

Auth::routes();

Route::get('/', 'HomeController@index');

Route::post('chat', 'ChatMessagesController@store');
