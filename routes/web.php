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
Route::prefix('plantuml')->group(function () {
    Route::get('/', 'Plantuml\ToolController@index')->name('plantuml.index');
    Route::get('/plantuml/create', 'Plantuml\ToolController@create')->name('plantuml.create');
    Route::post('/', 'Plantuml\ToolController@store')->name('plantuml.store');
    Route::get('/show_url/{name}', 'Plantuml\ToolController@show_url')->name('plantuml.show');
    Route::get('/build/uml', 'Plantuml\ToolController@build_uml')->name('plantuml.build');
    Route::get('/edit/{name}', 'Plantuml\ToolController@edit')->name('plantuml.edit');
    Route::put('/{name}', 'Plantuml\ToolController@update')->name('plantuml.update');
});



