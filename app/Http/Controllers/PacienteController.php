<?php

namespace App\Http\Controllers;

use App\User;
use App\Paciente;
use App\Endereco;
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
    public function index(Request $request)
    {
        try{
            // $pacientes = Paciente::orderBy('created_at', 'asc')->get();
            $valor = $request->busca;
            $pacientes = collect(); //inicializa uma colection vazia, tem métodos como count e outros exemplos
            $endereco = collect(); //inicializa uma colection vazia, tem métodos como count e outros exemplos
            
            if($request->input()){
                if($request->busca != null){
                    $pacientes = Paciente::where('nome', 'like', '%'.$valor.'%')->get();
                }
                
                if($pacientes->count() == 0 && $valor != null){
                    $request->session()->flash('error', "O paciente {$valor} não foi encontrado");
                } else if($valor == null){
                    $request->session()->flash('error', "O campo de busca não pode estar vazio");
                }
            }
            
        }
        catch(Exception $e){
            dd($e);
        }
        
        return view('tasks', [
            'pacientes' => $pacientes
        ]);
    }

    // Mostrar detalhes do paciente
    public function show($pacienteId, Request $request){
        $paciente = Paciente::find($pacienteId);
        return view('show', [
            'paciente' => $paciente
        ]);
    }

    // Gravar Pacientes
    public function gravar(Request $request){
        //dd($request->all());
    
    try{
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:pacientes,nome|max:30',
            'sobrenome' => 'required|max:30',
            'rua' => 'required|max:30',
            'numero' => 'required|max:30',
            'complemento' => 'max:30',
        ]);
    
        if ($validator->fails()) {
            return redirect('/adicionar')
                ->withInput()
                ->withErrors($validator);
        }
    
        $paciente = new Paciente;
        $endereco = new Endereco;
        $paciente->nome = $request->name;
        $paciente->sobrenome = $request->sobrenome;
        $endereco->rua = $request->rua;
        $endereco->numero = $request->numero;
        $endereco->complemento = $request->complemento;
        $paciente->save();
        $endereco->pacientes_id = $paciente->id;
        $endereco->save();
        $request->session()->flash('success', "O paciente {$paciente->nome} foi adicionado com sucesso");
        // $request->session()->flash('success', [
        //     'mensagem1' => 'olá! eu sou a primeira mensagem'
        //     'mensagem2' => 'olá! eu sou a segunda mensagem'
        //     'mensagem3' => 'olá! eu sou a terceira mensagem'
        // ]);
    }
    catch(Exception $e){
        dd($e->getMessage());
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

    public function create() {
        return view('adicionar');
    }

    public function editar($pacienteId, Request $request) {
        try{
            $paciente = Paciente::find($pacienteId);
           
            $paciente->nome = $request->nome;
            // dd($paciente->enderecos);
            $paciente->enderecos()->delete();

            foreach($request->input('rua') as $key => $rua){
                $endereco = Endereco::make();
                $endereco->rua = $request->rua[$key];
                $endereco->numero = $request->numero[$key];
                $endereco->complemento = $request->complemento[$key];
                $endereco->pacientes_id = $paciente->id;
                $endereco->save();
                
            }
            
            $paciente->update();
            $request->session()->flash('success', "O paciente {$paciente->nome} foi atualizado com sucesso");
        }catch(Exception $e){
            report($e);
            dd($e);
            $request->session()->flash('error', "Bro, deu merda");
        }
    
        return redirect('/');
    }
} 