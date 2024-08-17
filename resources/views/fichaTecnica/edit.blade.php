@extends('layouts.layout')

@section('title', 'Editar registro ' . $registros->nome)

@section('content')

<div class="col-md-6 offset-md-6" id="background-form">
    <h2>Editando: {{ $registros->nome }}</h2>
    <div id="form-body">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $registros->id }}" name="id">
            <div class="row mb-1">
                <div class="col-md-5">
                    <label for="image" class="form-label">Imagem:</label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    <img src="img/fichas/{{ $registros->image }}" alt="Imagem de: {{ $registros->nome }}" class="img-preview">
                </div>
            </div>
            <div class="row mb-1">
                <div class="col-md-5">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" value="{{ $registros->nome }}">
                </div>
                <div class="col-md-5">
                    <label for="raca" class="form-label">Raça:</label>
                    <input type="text" class="form-control" placeholder="Raça" name="raca" id="raca" value="{{ $registros->raca }}">
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-10">
                    <label for="especie" class="form-label">Espécie:</label>
                    <input type="text" class="form-control" placeholder="Espécie" name="especie" id="especie" value="{{ $registros->especie }}">
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-5">
                    <label for="peso" class="form-label">Peso:</label>
                    <input type="text" class="form-control" placeholder="Peso" name="peso" id="peso" value="{{ $registros->peso }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Tipo de Peso:</label>
                    <select class="form-select" name="tipoPeso">
                        <option value="0">Kilos</option>
                        <option value="1" {{ $registros->tipoPeso === 1 ? "selected='selected'" : "" }}>Gramas</option>
                    </select>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-10">
                    <label for="coloracao" class="form-label">Coloração:</label>
                    <input type="text" class="form-control" placeholder="Coloração" name="coloracao" id="coloracao" value="{{ $registros->coloracao }}">
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-5">
                    <label for="idade" class="form-label">Idade:</label>
                    <input type="text" class="form-control" placeholder="Idade" name="idade" id="idade" value="{{ $registros->idade }}">
                </div>
                <div class="col-md-5">
                    <label class="form-label">Tipo de Idade:</label>
                    <select class="form-select" name="tipoIdade">
                        <option value="0">Anos</option>
                        <option value="1" {{ $registros->tipoIdade === 1 ? "selected='selected'" : "" }}>Meses</option>
                    </select>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-10">
                    <label for="procedencia" class="form-label">Procedência:</label>
                    <input type="text" class="form-control" placeholder="Procedência" name="procedencia" id="procedencia" value="{{ $registros->procedencia }}">
                </div>
            </div>

            <div class="col-md-10">
                <label for="motivoCadastro" class="form-label">Motivo do cadastro:</label>
                <select class="form-select" name="motivoCadastro" id="motivoCadastro" onchange="internamento()" required>
                    @switch($registros->motivoCadastro)
                        @case(1)
                            <option value="{{$registros->motivoCadastro}}" selected>
                            <p>Serviços gerais</p>
                            </option>
                            <option value="2">Internamento</option>
                            <option value="3">Consulta</option>
                            @break
                        @case(2)
                            <option value="{{$registros->motivoCadastro}}" selected>
                                Internamento
                            </option>
                            <option value="1">Serviços gerais</option>
                            <option value="3">Consulta</option>
                            @break
                        @case(3)
                            <option value="{{$registros->motivoCadastro}}" selected>
                                Consulta
                            </option>
                            <option value="1">Serviços gerais</option>
                            <option value="2">Internamento</option>
                            @break
                    @endswitch
                </select>
            </div>

            <div class="row mb-2">
                <div @if ($registros->motivoCadastro != 2) style="display: none" @endif id="internamentoSituacao" >
                    <div class="row mb-2">
                        <div class="col-md-10">
                            <label for="situacaoInternacao" class="form-label">Situação:</label>
                            <select class="form-select" name="situacaoInternacao" id="situacaoInternacao" required>
                                <option value="1" selected>Urgência</option>
                                <option value="2">Clínica</option>
                                <option value="3">Cirúgico</option>
                                <option value="4">Terapêutico</option>
                                <option value="5">Observação</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-md-10">
                            <label>Dr(a) responsável:</label>
                            <select class="form-select" name="drResponsavel" id="drResponsavel" required></select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-1">
                <div class="col-md-12">
                    <input class="btn btn-success" type="submit" value="Salvar">
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    function internamento(){
        if($('#motivoCadastro').val() == 2){
            $('#internamentoSituacao').show();
        }else{
            $('#internamentoSituacao').hide();
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var token = "{{ auth()->user()->createToken('auth_token')->plainTextToken }}";

            $.ajax({
                url: "{{ route('patient.update') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    window.location.href = "{{ route('patient.dashboard') }}";
                },
                error: function(response) {
                    alert('Erro ao editar paciente.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";

        $.ajax({
            url: "{{ route('doctor.all') }}",
            type: 'GET',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                const doctors = response.Doutores;

                doctors.forEach(doctor => {
                    $('#drResponsavel').prepend(
                        '<option value="'+doctor.id+'">'+doctor.name+'</option>'
                    );
                });
            },
            error: function(response) {
                alert('Erro ao resgatar doutores.');
            }
        });
    });
</script>

@endsection