@extends('layouts.app')

@section('css')
    <link href="{{ elixir('css/testecss.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
<div class="form-row enderecoClone hide">
    <div class="col-md-4">
        <label for="task-rua" class="control-label">Rua</label>
        <input type="text" name="rua[]" id="rua" class="form-control" value="">
    </div>
    <div class="col-md-4">
        <label for="task-numero" class=" control-label">Número</label>
        <input type="number" name="numero[]" id="numero" class="form-control" value="">
    </div>
    <div class="col-md-4">
        <label for="task-complemento" class="control-label">Complemento</label>
        <input type="text" name="complemento[]" id="complemento" class="form-control" value="">
    </div>
</div>
<div class="panel panel-default" style="width: 600px; margin-left:25%">
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
                        <div id="enderecos">
                            <div class="form-row">
                                <div class="form-group">
                                    <div class="col-md-6">
                                        <label for="task-name" class="control-label">Nome</label>
                                        <input type="text" name="name" id="task-name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <label for="task-sobrenome" class="control-label">Sobrenome</label>
                                        <input type="text" name="sobrenome" id="task-sobrenome" class="form-control" value="{{ old('sobrenome') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-row endereco">
                                <div class="col-md-4">
                                    <label for="task-rua" class="control-label">Rua</label><i id="plus" class="fas fa-plus"></i><i class="fas fa-minus-circle"></i>
                                    <input type="text" name="rua[]" id="task-rua" class="form-control" value="">
                                </div>
                                <div class="col-md-4">
                                    <label for="task-numero" class=" control-label">Número</label>
                                    <input type="number" name="numero[]" id="task-numero" class="form-control" value="">
                                </div>
                                <div class="col-md-4">
                                    <label for="task-complemento" class="control-label">Complemento</label>
                                    <input type="text" name="complemento[]" id="task-complemento" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                       
                        <!-- Add Task Button -->
                        <div id="botaoAdicionarPaciente">
                            <button type="submit" id="adicionar" class="btn btn-default">
                                <i class="fa fa-btn fa-plus"></i>Adicionar Paciente
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection