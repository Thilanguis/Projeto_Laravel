@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">

            <!-- Current Tasks -->
            @if (count($pacientes) > 0)
                <div class="panel panel-default">
                @include('partials.feedback')
                @include('common.errors')
                    <div class="panel-heading">
                        Lista de Pacientes
                        <a class="btn btn-primary" href="{{ url('/adicionar') }}">Adicionar</a>
                    </div>

                    <div class="panel-body">
                        <table class="table table-striped task-table">
                            <thead>
                                <th>id</th>
                                <th>Nome</th>
                                <th>sobrenome</th>
                                <th>&nbsp;</th>
                            </thead>
                            <tbody>
                                @foreach ($pacientes as $paciente)
                                    <tr>
                                        <td class="table-text"><div><i class="fas fa-id-card-alt"></i></i></div></td>

                                        <td class="table-text"><div>{{ $paciente->nome }}</div></td>
                                        <td class="table-text"><div>{{ $paciente->sobrenome }}</div></td>

                                        <!-- Task Update Button -->
                                        <td>
                                            <form action="{{ url('editar/'.$paciente->id) }}" method="GET">
                                                
                                                
                                                <button type="submit" class="btn btn-info">
                                                    <i class="fas fa-user-edit"></i> Editar
                                                </button>
                                            </form>
                                        </td>

                                        <!-- Task Delete Button -->
                                        <td>
                                            <form action="{{ url('task/'.$paciente->id) }}" method="POST" class="deleta">
                                                {{ csrf_field() }} 
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger deletar">
                                                    <i class="fa fa-btn fa-trash"></i>Deletar
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
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ elixir('js/action.js') }}"></script>
@endsection
