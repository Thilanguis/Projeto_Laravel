@extends('layouts.app')

@section('content')
<div class="container">
<div class="panel panel-default">
                <div class="panel-heading">
                    Adicionar Pacientes
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
        </div>
    </div>
</div>
@endsection