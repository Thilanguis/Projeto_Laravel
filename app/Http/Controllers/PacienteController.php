<?php

namespace App\Http\Controllers;

use App\User;
use App\Paciente;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Exception;

class PacienteController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @return Response
     */
    // Consultar Pacientes
    public function index()
    {
        $pacientes = Paciente::orderBy('created_at', 'asc')->get();

        return view('tasks', [
            'pacientes' => $pacientes
        ]);
    }

    // Gravar Pacientes
    public function gravar(Request $request){
        //dd($request->all());
    
    try{
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:pacientes,nome|max:30',
            'sobrenome' => 'required|max:30',
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
    }

    public function deletar($pacienteId){
        $paciente = Paciente::find($pacienteId);
        $paciente->delete();
    
        return redirect('/');
    }

    public function indexEditar($pacienteId, Request $request) {
        $paciente = Paciente::find($pacienteId);
        return view('editar', [
        'paciente' => $paciente]);
    }

    public function editar($pacienteId, Request $request) {
        try{
            $paciente = Paciente::find($pacienteId);
    
            $paciente->nome = $request->nome;
            $paciente->update();
            $request->session()->flash('success', "O paciente {$paciente->nome} foi atualizado com sucesso");
        }catch(Exception $e){
            report($e);
            $request->session()->flash('error', "Bro, deu merda");
        }
    
        return redirect('/');
    }
} 