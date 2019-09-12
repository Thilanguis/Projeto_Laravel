@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                    New Task
                </div>

                @include('partials.feedback')

                <div class="panel-body">
                    <!-- Display Validation Errors -->
                    @include('common.errors')

                    <!-- New Task Form -->
                    <form action="{{ url('task')}}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Task Name -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="task-name" class="col-sm-3 control-label">Nome</label>
                                <input type="text" name="name" id="task-name" class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="task-sobrenome" class="col-sm-3 control-label">Sobrenome</label>
                                <input type="text" name="sobrenome" id="task-sobrenome" class="form-control" value="{{ old('sobrenome') }}">
                            </div>
                        </div>

                        <!-- Add Task Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" id="adicionar" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Adicionar Paciente
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Current Tasks -->
            @if (count($pacientes) > 0)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Tasks
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
                                            <form action="{{ url('task/'.$paciente->id) }}" method="POST">
                                                {{ csrf_field() }} 
                                                {{ method_field('DELETE') }}

                                                <button type="submit" class="btn btn-danger">
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
