<?php


Route::get('/', function () {
    return view('welcome');
})->middleware(['guest']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::pattern('users','[0-9]+');
Route::resource('usuarios', 'Usercontroller')->middleware('auth');
Route::put('usuarios/picture/{usuario}', 'UserController@update_image')->name('usuarios.actualizarimagen');

Route::get('equipos',function(){
   return 'Modulo de equipos';
});


//Route::middleware(['auth'])->prefix('usuarios/')->group(function () {
//
//    Route::get('', 'UserController@index')->name('usuarios.index');
//
//    Route::post('', 'UserController@store')->name('usuarios.store');
//
//    Route::get('create', 'UserController@create')->name('usuarios.create');
//
//    Route::get('{user}','UserController@show')->name('usuarios.show');
//
//    Route::put('{user}', 'UserController@update')->name('usuarios.update');
//
//    Route::delete('{user}', 'UserController@destroy')->name('usuarios.destroy');
//
//    Route::get('{user}/edit', 'UserController@edit')->name('usuarios.edit');
//
//
////    Route::put('picture/{user}', 'UserController@update_image')->name('usuarios.actualizarimagen');
//
//});
