@if (session('success'))
    <div id="success" class="alert alert-success animated fadeIn">
        {{ session('success') }}
    </div>
@endif
<!-- @if (session('alert'))
    <div class="alert alert-alert">
        {{ session('alert')['mensagem2'] }}
    </div>
@endif -->
@if (session('error'))
        <div id="success" class="alert alert-danger animated fadeIn">
            {{ session('error') }}
        </div>
@endif