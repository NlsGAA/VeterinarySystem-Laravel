@extends('layouts.layout')

@section('title', 'Criar novo registro')

@section('content')

<div class="container mt-5">
    <div class="col-md-12 offset-md-1 shadow-lg bg-white rounded p-2 d-inline-block">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row p-3 w-100">
                <div class="row mb-2">
                    <div class="col-md-5">
                        <label for="image" class="form-label fw-bold fw-bold">Imagem:</label>
                        <input type="file" class="form-control-file" id="image" name="image[]" multiple>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-5">
                        <label for="nome" class="form-label fw-bold">Nome:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Nome" name="nome" id="nome" required>
                    </div>
                    <div class="col-md-5">
                        <label for="raca" class="form-label fw-bold">Raça:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Raça" name="raca" id="raca" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-10">
                        <label for="especie" class="form-label fw-bold">Espécie:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Espécie" name="especie" id="especie" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-5">
                        <label for="peso" class="form-label fw-bold">Peso:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Peso" name="peso" id="peso" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Tipo de Peso:<span class="text-danger">*</span></label>
                        <select class="form-select" name="tipoPeso" id="tipoPeso" required>
                            <option value="0">Kilos</option>
                            <option value="1">Gramas</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-10">
                        <label class="form-label fw-bold">Responsável:<span class="text-danger">*</span></label>
                        <select class="form-select" name="patientOwner" id="patientOwner" required></select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-10">
                        <label for="coloracao" class="form-label fw-bold">Coloração:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Coloração" name="coloracao" id="coloracao" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-5">
                        <label for="idade" class="form-label fw-bold">Idade:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Idade" name="idade" id="idade" required>
                    </div>
                    <div class="col-md-5">
                        <label class="form-label fw-bold">Tipo de Idade:<span class="text-danger">*</span></label>
                        <select class="form-select" name="tipoIdade" id="tipoIdade" required>
                            <option value="0">Anos</option>
                            <option value="1">Meses</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-10">
                        <label for="procedencia" class="form-label fw-bold">Procedência:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control" placeholder="Procedência" name="procedencia" id="procedencia" required>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-10">
                        <label for="motivoCadastro" class="form-label fw-bold">Motivo do cadastro:<span class="text-danger">*</span></label>
                        <select class="form-select" name="motivoCadastro" id="motivoCadastro" onchange="internamento()" required>
                            <option value="1" selected>Serviços gerais</option>
                            <option value="2">Internamento</option>
                            <option value="3">Consulta</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2">
                    <div style="display: none" id="internamentoSituacao" >
                        <div class="row mb-2">
                            <div class="col-md-10">
                                <label for="situacaoInternacao" class="form-label fw-bold">Situação:<span class="text-danger">*</span></label>
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
                                <label class="form-label fw-bold">Dr(a) responsável:<span class="text-danger">*</span></label>
                                <select class="form-select" name="drResponsavel" id="drResponsavel" required></select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <input class="btn btn-success" type="submit" value="Registrar">
                    </div>
                </div>
            </div>
        </form>
    </div>
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
            var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";

            console.log(formData)

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

        $.ajax({
            url: "{{ route('owners.all') }}",
            type: 'GET',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                console.log(response)
                response.forEach(owner => {
                    $('#patientOwner').prepend(
                        '<option value="'+owner.id+'">'+owner.firstName + ' ' + owner.lastName+'</option>'
                    );
                });
            },
            error: function(response) {
                alert('Erro ao resgatar donos.');
            }
        });
});

</script>

@endsection
