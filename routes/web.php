<?php

use App\Paciente;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    $pacientes = Paciente::orderBy('created_at', 'asc')->get();

    return view('tasks', [
        'pacientes' => $pacientes
    ]);
});

/* 
*Adicionar Task
 */
Route::post('/task', function (Request $request) {
    //dd($request->all());
    
    try{
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:pacientes,nome|max:30',
            'sobrenome' => 'required|unique:pacientes,sobrenome|max:30',
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
    
        $paciente = new Paciente;
        $paciente->nome = $request->name;
        $paciente->sobrenome = $request->sobrenome;
        $paciente->save();
        $request->session()->flash('success', "O paciente {$paciente->nome} foi adicionado com sucesso");
        // $request->session()->flash('success', [
        //     'mensagem1' => 'olá! eu sou a primeira mensagem'
        //     'mensagem2' => 'olá! eu sou a segunda mensagem'
        //     'mensagem3' => 'olá! eu sou a terceira mensagem'
        // ]);

    }
    catch(\Exception $e){
        // dd($e->getMessage());
        $request->session()->flash('error', "Ops, não adicionou");
    }

    return redirect('/');
});
/**
* Delete Task
*/

Route::delete('/task/{task}', function ($pacienteId) {
    $paciente = Paciente::find($pacienteId);
    $paciente->delete();

    return redirect('/');
});
// Route::delete('/task/{task}', 'PacienteController@destroy');

/**
* form-editar Task
*/

Route::get('/editar/{task}', function ($pacienteId, Request $request) {
    $paciente = Paciente::find($pacienteId);
    return view('editar', [
        'paciente' => $paciente
    ]);
});

/**
* editar Task
*/

Route::put('/editar/{task}', function ($pacienteId, Request $request) {
    try{
        $paciente = Paciente::find($pacienteId);

        $paciente->nome = $request->nome;
        $paciente->update();
        $request->session()->flash('success', "O paciente {$paciente->nome} foi atualizado com sucesso");
    }catch(\Exception $e){
        report($e);
        $request->session()->flash('error', "Bro, deu merda");
    }

    return redirect('/');
});