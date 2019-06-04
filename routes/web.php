<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Plantuml\ToolController@index')->name('homepage.index');

Route::prefix('plantuml')->middleware('auth')->group(function () {
    Route::get('/', 'Plantuml\ToolController@index')->name('plantuml.index');
    Route::get('/create', 'Plantuml\ToolController@create')->name('plantuml.create');
    Route::post('/', 'Plantuml\ToolController@store')->name('plantuml.store');

    Route::get('/build/uml', 'Plantuml\ToolController@build_uml')->name('plantuml.build');
    Route::get('/edit/{name}', 'Plantuml\ToolController@edit')->name('plantuml.edit');
    Route::put('/{name}', 'Plantuml\ToolController@update')->name('plantuml.update');
});

Route::prefix('plantuml')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/show_url/{project}/{name}', 'Plantuml\ToolController@show_url')->name('plantuml.show');
    Route::get('/show_url/{name}', 'Plantuml\ToolController@show_url')->name('plantuml.show');
});

Auth::routes();

