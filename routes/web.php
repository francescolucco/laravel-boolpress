<?php

use Illuminate\Support\Facades\Route;




Auth::routes();

Route::middleware('auth')
        ->namespace('Admin')
        ->name('admin.')
        ->prefix('admin')
        ->group(function(){
            Route::get('/', 'HomeController@index')->name('index');

            // QUI SI METTONO LE ROTTE PROTETTE DA PASSWORD
            Route::resource('/posts', 'PostsController');
        });

Route::get('{any?}', function () {
    return view('guest.home');
})->where('any', '.*')->name('home');
    

