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

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'PacienteController@index');
    
    Route::get('/show/{id}', 'PacienteController@show');
    
    Route::get('/adicionar', 'PacienteController@create');
    
    Route::post('/task','PacienteController@gravar');
    
    Route::delete('/task/{task}', 'PacienteController@deletar');
    
    Route::get('/editar/{task}', 'PacienteController@indexEditar')->name('paciente.edit');
    
    Route::put('/editar/{task}', 'PacienteController@editar');

    
});    

Route::get('/home', 'HomeController@index')->name('home');