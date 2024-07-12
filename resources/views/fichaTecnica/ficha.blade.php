@extends('layouts.layout')

@section('title', 'Criar novo registro')

@section('content')

    <div class="col-md-12 offset-md-6" id="background-form">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div id="form-body">
                <div class="row mb-1">
                    <div class="col-md-5">
                        <label for="image" class="form-label">Imagem:</label>
                        <input type="file" class="form-control-file" id="image" name="image">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-md-5">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome">
                    </div>
                    <div class="col-md-5">
                        <label for="raca" class="form-label">Raça:</label>
                        <input type="text" class="form-control" placeholder="Raça" name="raca" id="raca">
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-10">
                        <label for="especie" class="form-label">Espécie:</label>
                        <input type="text" class="form-control" placeholder="Espécie" name="especie" id="especie">
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-5">
                        <label for="peso" class="form-label">Peso:</label>
                        <input type="text" class="form-control" placeholder="Peso" name="peso" id="peso">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Tipo de Peso:</label>
                        <select class="form-select" name="tipoPeso" id="tipoPeso">
                            <option value="0">Kilos</option>
                            <option value="1">Gramas</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-10">
                        <label for="coloracao" class="form-label">Coloração:</label>
                        <input type="text" class="form-control" placeholder="Coloração" name="coloracao" id="coloracao">
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-5">
                        <label for="idade" class="form-label">Idade:</label>
                        <input type="text" class="form-control" placeholder="Idade" name="idade" id="idade">
                    </div>
                    <div class="col-md-5">
                        <label class="form-label">Tipo de Idade:</label>
                        <select class="form-select" name="tipoIdade" id="tipoIdade">
                            <option value="0">Anos</option>
                            <option value="1">Meses</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-1">
                    <div class="col-md-10">
                        <label for="procedencia" class="form-label">Procedência:</label>
                        <input type="text" class="form-control" placeholder="Procedência" name="procedencia" id="procedencia">
                    </div>
                </div>

                <div class="col-md-10">
                    <label for="motivoCadastro" class="form-label">Motivo do cadastro:</label>
                    <select class="form-select" name="motivoCadastro" id="motivoCadastro" required>
                        <option value="1" selected>Serviços gerais</option>
                        <option value="2">Internamento</option>
                        <option value="3">Consulta</option>
                    </select>
                </div>

                <div class="row mb-1">
                    <div class="col-md-12">
                        <input class="btn btn-success" type="submit" value="Registrar">
                    </div>
                </div>
            </div>
        </form>
    </div>

<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";

            $.ajax({
                url: "{{ route('patient.create') }}",
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
                    alert('Erro ao criar paciente.');
                }
            });
        });
    });
</script>

@endsection
