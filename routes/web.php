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

//Route::get('/', 'Plantuml\ToolController@index')->name('homepage.index');
Route::get('/home', 'Plantuml\ToolController@index')->name('homepage.h');

Route::prefix('plantuml')->group(function () {
    //Route::get('/show_url/{project}/{name}.{type}', 'Plantuml\ToolController@show_url')->name('plantuml.show');
    Route::get('/show_url/{project}/{name}', 'Plantuml\ToolController@show_url')->name('plantuml.show');
    Route::get('/show_url/{name}', 'Plantuml\ToolController@show_url')->name('plantuml.show');
});


Route::prefix('plantuml')->middleware('auth')->group(function () {
    Route::post('/save-category', 'Plantuml\CategoryController@store')->name('category.store');
    Route::get('project/{name}', 'Plantuml\ToolController@showproject')->name('project.show');
    Route::get('/', 'Plantuml\ToolController@index')->name('plantuml.index');
    Route::get('/create', 'Plantuml\ToolController@create')->name('plantuml.create');
    Route::post('/', 'Plantuml\ToolController@store')->name('plantuml.store');

    Route::get('/build/uml', 'Plantuml\ToolController@build_uml')->name('plantuml.build');
    Route::get('/edit/{name}', 'Plantuml\ToolController@edit')->name('plantuml.edit');
    Route::put('/{name}', 'Plantuml\ToolController@update')->name('plantuml.update');
    Route::get('/byuser', 'Plantuml\UserumlController@index')->name('plantuml.byuser');
});

Route::get('/404', function(){
    return view('404');
})->name('404');

Route::prefix('japanese')->group(function () {
});
Route::get('/', 'Japanese\JapaneseController@index')->name('japanese.index');
Route::get('/game', 'Japanese\JapaneseController@game')->name('japanese.game');
Route::get('/card', 'Japanese\JapaneseController@card')->name('japanese.card');

Auth::routes();


