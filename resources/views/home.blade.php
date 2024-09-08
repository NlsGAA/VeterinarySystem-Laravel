@extends('layouts.layout')
@section('title', 'VetSystem')

@section('content')

@auth

@if($search)
<h5> Buscando por: {{ $search }} </h5>
@else
<h5> Veja todos os registros: </h5>
@endif
@if (count($registros) == 0 && $search)
<p>Não foi possível encontrar nenhum registro com {{ $search }}! Clique <a href="/">aqui</a> para ver todos</p>
@elseif (count($registros) == 0)
<p>Não há nenhum registro disponível</p>
@endif

<x-filter-bar></x-filter-bar>

<div id="card-animals" class="row col-md-6"></div>
@endauth

<script>
    var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";

    function displayPatients(response){
        $('.patient-card-atr').remove();

        const patients = response.pacientes

        patients.forEach(patient => {
            let patientWeightType = ' Kilos';
            if(patient.tipoPeso !== 0){
                let patientWeightType = ' Gramas'
            }
            
            let patientYearsType = ' Anos'
            if(patient.tipoIdade !== 0){
                let patientYearsType = ' Meses'
            }

            $('#card-animals').prepend(
                '<div class="card col-md-3 patient-card-atr">' +
                    '<img src="img/'+ patient.image +'" class="card-img-top" alt="imagem de:'+ patient.nome +'">' +
                    '<div class="card-body">' +
                        '<h5 class="card-title">'+ patient.nome +'</h5>' +
                        '<p class="card-text">Alguma informação</p>' +
                    '</div>' +
                    '<ul class="list-group list-group-flush">' +
                        '<li class="list-group-item">Raça:'+ patient.raca +'<li>' +
                        '<li class="list-group-item">Peso:'+ patient.peso + patientWeightType +
                        '<li>' +
                        '<li class="list-group-item">Idade:'+ patient.idade + patientYearsType +
                        '<li>' +
                    '</ul>' +
                    '<div class="card-body">' +
                        '<a href="/fichaTecnica/'+ patient.id +'" class="card-link">Detalhado</a>' +
                    '</div>' +
                '</div>'
            );
        });
    }

</script>

<script>
    function getAllPatient(){
        $.ajax({
            url: "/api/patients/",
            type: 'GET',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                displayPatients(response);
            },
            error: function(response) {
                alert('Erro ao deletar paciente');
            }
        });
    }

    $(document).ready(function(){
        getAllPatient();
    });

</script>

@endsection