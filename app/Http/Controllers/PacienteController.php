<?php

namespace App\Http\Controllers;

use App\User;
use App\Paciente;
use App\Endereco;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Exception;
use Auth;

class PacienteController extends Controller
{
    /**
     * 
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

                $pacientes = Paciente::query();
                
                $pacientes->whereHas('users', function($query){
                    $query->where('users_id', Auth::user()->id);
                });

                if($request->busca != null){
                    $pacientes->where('nome', 'like', "%{$valor}%");
                    $pacientes = $pacientes->get();                     
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
        // dd($paciente->users, Auth::user()->pacientes);
        // dd($paciente->users);
       
        $this->authorize('update-post');

        return view('show', [
            'paciente' => $paciente
        ]);
    }

    // Gravar Pacientes
    public function gravar(Request $request){
    try{
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:pacientes,nome|max:30',
            'sobrenome' => 'required|max:30',
            'rua' => 'required|array|max:30',
            'rua.*' => 'required|string|distinct|max:30',
            'numero' => 'required|array|max:30',
            'numero.*' => 'required|string|distinct|max:30',
            'complemento' => 'max:30',
        ]);
    
        if ($validator->fails()) {
            return redirect('/adicionar')
                ->withInput()
                ->withErrors($validator);
        }
        
        $paciente = new Paciente;
        $paciente->nome = $request->name;
        $paciente->sobrenome = $request->sobrenome;

        $paciente->save();
        foreach($request->input('rua') as $key => $rua){
            $endereco = new Endereco;
            $endereco->rua = $request->rua[$key];
            $endereco->numero = $request->numero[$key];
            $endereco->complemento = $request->complemento[$key];
            $endereco->pacientes_id = $paciente->id;
            
            $endereco->save();
        }

        $paciente->users()->attach(Auth::user()->id); //atribuindo o id do usuário logado no relacionamento paciente->users

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
    // return redirect('/')->back()->withInput();
    }

    public function deletar($pacienteId, Request $request){
        $paciente = Paciente::find($pacienteId);
        dd($paciente);
        // $pacientes->enderecos()->ativos()->get(); ativos() esta chamando scopeAtivos
        $paciente->enderecos()->delete();
        $paciente->users()->detach(Auth::user()->id);
        $paciente->delete();
        $request->session()->flash('success', "O paciente {$paciente->nome} foi adicionado com sucesso");
    
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

            // dd($request->input());
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:pacientes,nome|max:30',
                'sobrenome' => 'required|max:30',
                'rua' => 'required|array|max:30',
                'rua.*' => 'required|string|distinct|max:30',
                'numero' => 'required|array|max:30',
                'numero.*' => 'required|string|distinct|max:30',
                'complemento' => 'max:30',
            ]);
        
            if ($validator->fails()) {
                return redirect()->route('paciente.edit', $pacienteId)
                    ->withInput()
                    ->withErrors($validator);
            }

            $paciente = Paciente::find($pacienteId);
           
            $paciente->nome = $request->name;
            $paciente->sobrenome = $request->sobrenome;
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
            dd($e);
            // report($e);
            // dd($request->input());
            $request->session()->flash('error', "Bro, deu merda");
        }
    
        return redirect('/');
    }
} 