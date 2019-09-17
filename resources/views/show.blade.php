@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Current Tasks -->
           
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Registro</th>
                                <th>Rua</th>
                                <th>Número</th>
                                <th>Complemento</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <tbody>
                               
                                    {{ csrf_field() }} 
                                    {{ method_field('PUT') }}
                                    <tr>
                                       
                                        <td class="table-text"><div>{{ $paciente->nome }}</div></td>
                                        <td class="table-text"><div>{{ $paciente->sobrenome }}</div></td>
                                        <td class="table-text"><div>{{ $paciente->created_at }}</div></td>
                                        
                                        @foreach($paciente->enderecos as $endereco)
                                            <td class="table-text"><div>{{ $endereco->rua }}</div></td>
                                            <td class="table-text"><div>{{ $endereco->numero }}</div></td>
                                            <td class="table-text"><div>{{ $endereco->complemento }}</div></td>
                                        @endforeach                                    
                                    </tr>
                               
                            </tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
@endsection
