@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-1 col-sm-10 animted zoomIn">

            <!-- Current Tasks -->
           
                <div class="panel panel-default animated zoomIn">
                    <div class="panel-heading">
                        Current Tasks
                    </div>
                    @include('partials.feedback')
                    <div class="panel-body">
                    @include('common.errors')
                        <table class="table table-striped task-table">
                            <thead>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Registro</th>
                            </thead>
                            
                            <tbody>
                                <form action="{{ url('editar/'.$paciente->id) }}" method="POST">
                                    {{ csrf_field() }} 
                                    {{ method_field('PUT') }}
                                    <tr>
                                        <td><input class="form-control" name="name" value="{{$paciente->nome}}" class="table-text"></td>
                                        <td><input class="form-control" name="sobrenome" value="{{$paciente->sobrenome}}" class="table-text"></td>
                                        <td><input class="form-control" disabled value="{{$paciente->created_at}}" class="table-text"></td>
                                    </tr>
                                    <tr>
                                      
                                <thead>
                                    <th>Rua</th>
                                    <th>Número</th>
                                    <th>Complemento</th>
                                    <th>&nbsp;</th>
                                </thead> 
                                        @foreach($paciente->enderecos as $endereco)   
                            
                                    <tr>                            
                                        <td><input class="form-control" value="{{$endereco->rua}}" name="rua[]" type="text" class="table-text"></td>                                    
                                        <td><input class="form-control" value="{{$endereco->numero}}" name="numero[]" type="number" class="table-text"></td>                                    
                                        <td><input class="form-control" value="{{$endereco->complemento}}" name="complemento[]" type="text" class="table-text"></td>  
                                    </tr>   
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
