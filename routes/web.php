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

Route::get('/', 'PacienteController@index');

Route::get('/adicionar', 'PacienteController@create');

Route::post('/task','PacienteController@gravar');

Route::delete('/task/{task}', 'PacienteController@deletar');

Route::get('/editar/{task}', 'PacienteController@indexEditar');

Route::put('/editar/{task}', 'PacienteController@editar');