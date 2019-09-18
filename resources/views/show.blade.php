@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Current Tasks -->
           
                <div class="panel panel-default animated rollIn">
                    <div class="panel-heading">
                        Dados do {{$paciente->nome}}
                    </div>
                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <tbody>
                                {{$paciente->users[0]->pivot->users_id}}
                                <br>
                                {{$paciente->users[0]->pivot->pacientes_id}}
                                    {{ csrf_field() }} 
                                    {{ method_field('PUT') }}
                                    <tr>
                                        <div><label for="">Nome:</label>&nbsp;{{ $paciente->nome }}</div>
                                        <div><label for="">Sobrenome:</label>&nbsp;{{ $paciente->sobrenome }}</div>
                                        <div><label for="">Registro:</label>&nbsp;{{ $paciente->created_at }}&nbsp;</div>
                                        
                                        @foreach($paciente->enderecos as $key => $endereco)
                                            <p><div><label for="">Endereço {{ $key + 1 }}:</label>&nbsp;{{ $endereco->rua }},
                                            {{ "nº ".$endereco->numero }}
                                            {{ $endereco->complemento }}</div></p>
                                        @endforeach                                    
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection
