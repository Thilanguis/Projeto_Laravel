@extends('layouts.app')

@section('css')
    <link href="{{ elixir('css/testecss.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="itensMenu">
                 <a class="itensMenu" href="{{ url('/adicionar') }}"><i class="fas fa-plus-circle"></i><b><p>Adicionar paciente</b></p></a>
            </div>
        <form action="{{url('/')}}" method="GET">            
            <div class="row">
                <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="busca">
                </div>
                <div class="form-group col-md-6">
                    <button class="itensMenu" type="submit"><i class="fab fa-searchengin"></i></button>
                </div>
            </div>
        </form>
                <!-- Current Tasks -->
                <div class="panel panel-default animated zoomIn">
                        
                            @include('partials.feedback')
                            @include('common.errors')
                        
                    <div class="panel-heading">
                        Lista de Pacientes
                    </div>
                        @if (count($pacientes) > 0)
      
                    <div class="panel-body ">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>id</th>
                                <th>Nome</th>
                                <th>Sobrenome</th>
                                <th>Editar</th>
                                <th>Mostrar</th>
                                <th>Deletar</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($pacientes as $paciente)
                                <tr class="linhaPaciente">
                                    <td class="table-text"><div><i class="fas fa-id-card-alt"></i></i></div></td>

                                    <td class="table-text"><div class="nomePaciente">{{ $paciente->nome }}</div></td>
                                    <td class="table-text"><div>{{ $paciente->sobrenome }}</div></td>
                                    
                                    <!-- Task Update Button -->
                                        <td>
                                            <form action="{{ url('editar/'.$paciente->id) }}" method="GET">
                                            <button type="submit" class="btn btn-info">
                                                <i class="fas fa-user-edit"></i> Editar
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ url('show/'.$paciente->id) }}" method="GET">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="far fa-eye"></i> Mostrar
                                                </button>
                                            </form>
                                        </td>
                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('task/'.$paciente->id) }}" method="POST" class="deleta">
                                            {{ csrf_field() }} 
                                            {{ method_field('DELETE') }}
                                            
                                          
                                            
                                            <button type="submit" class="btn btn-danger deletar">
                                                    <i class="fa fa-btn fa-trash"></i> Deletar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif  
                <p><b>Total de Pacientes encontrados: {{ $pacientes->count() }}</b></p>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ elixir('js/action.js') }}"></script>
@endsection