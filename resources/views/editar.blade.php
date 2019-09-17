@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10">

            <!-- Current Tasks -->
           
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Nome</th>
                                <th>Registro</th>
                                <th>Rua</th>
                                <th>Número</th>
                                <th>Complemento</th>
                                <th>&nbsp;</th>
                            </thead>
                            
                            <tbody>
                                <form action="{{ url('editar/'.$paciente->id) }}" method="POST">
                                    {{ csrf_field() }} 
                                    {{ method_field('PUT') }}
                                    <tr>
                                        <td><input name="nome" value="{{$paciente->nome}}" class="table-text"></td>
                                        <td><input disabled value="{{$paciente->created_at}}" class="table-text"></td>    
                                        @foreach($paciente->enderecos as $endereco)                                
                                        <td><input value="{{$endereco->rua}}" name="rua[]" type="text" class="table-text"></td>                                    
                                        <td><input value="{{$endereco->numero}}" name="numero[]" type="number" class="table-text"></td>                                    
                                        <td><input value="{{$endereco->complemento}}" name="complemento[]" type="text" class="table-text"></td>  
                                        @endforeach                                  
                                    </tr>
                               
                            </tbody>
                        </table>
                                    <input type="submit" class="btn btn-primary" value="Atualizar">
                                </form>
                    </div>
                </div>
           
        </div>
    </div>
@endsection
