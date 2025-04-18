@extends('layouts.layout')
@section('title', 'Internação')

@section('content')
@auth
    
<div class="col-md-12 row">
    <div class="mt-4">
        <div class="container">
            <table border="1px" class="table">
                <thead>
                    <tr>
                        <th>
                            Paciente:
                        </th>
                        <th>
                            Doutor(a) Responsável:
                        </th>
                        <th>
                            Status Internação:
                        </th>
                        <th>
                            Data de entrada:
                        </th>
                        <th>
                            Dias internados:
                        </th>
                        <th>
                            Ações:
                        </th>
                    </tr>
                </thead>
                <tbody id="patient_information"></tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";

        $.ajax({
            url: "{{ route('hospitalized.all') }}",
            type: 'GET',
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                const patients = response.pacientes;
                patients.forEach(patient => {
                    $('#patient_information').prepend(
                        '<tr>' +
                            '<td>' + patient.patient_data.nome + '</td>' +
                            '<td>' + patient.patient_data.doctor_name + '</td>' +
                            '<td>' + patient.patient_data.name_situation + '</td>' +
                            '<td>' + patient.entry_date + '</td>' +
                            '<td>' + patient.days_hospitalized + '</td>' +
                            '<td>' + '<button class="btn btn-info">Dar alta</button>' + '</td>' +
                        '</tr>'
                    );
                });
            },
            error: function(response) {
                alert('Erro recuperar pacientes');
            }
        });
    });
</script>

@endauth
@endsection