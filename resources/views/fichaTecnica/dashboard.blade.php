@extends('layouts.layout')
@section('title', 'Dashboard')

@section('content')

<div class="dashboard-title-container">
    <h2>Meus registros:</h2>
    <a href="/fichaTecnica" class="btn btn-success btn-md" >NOVO+</a>
</div>
<div class="dashboard-registros-container">
    @if($registros != null && count($registros) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Raça</th>
                    <th scope="col">Procedência</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $registro)
                <tr>
                    <td scope="row">{{ $registro->id }}</td>
                    <td><a href="fichaTecnica/{{ $registro->id }}">{{ $registro->nome }}</a></td>
                    <td>
                        <span>{{ $registro->raca }}</span>
                    </td>
                    <td>
                        <span>{{ $registro->procedencia }}</span>
                    </td>
                    <td>
                        @switch($registro->motivoCadastro)
                            @case(1)
                                <span>Serviços gerais</span>
                                @break
                            @case(2)
                                <span>Internamento</span>
                                @break
                            @case(3)
                                <span>Consulta</span>
                                @break
                            @default
                                <span>Status do paciente não definido</span>
                        @endswitch
                    </td>
                    <td>
                        <a href="/fichaTecnica/edit/{{$registro->id}}" class="btn btn-info edit-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                              </svg>
                              Editar
                        </a>
                        <a href="/api/patients/delete/{{$registro->id}}"  id="delete_patient" class="btn btn-danger delete-btn" data-id="{{ $registro->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                            </svg>
                            Deletar
                        </a>                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
    <p>Você ainda não possui nenhum registro, <a href="/fichaTecnica/">criar um registro</a>.</p>
    @endif
</div>

{{-- <script>
$(document).ready(function() {
    $('#delete_patient').on('click', function(e) {
        e.preventDefault();

        var patientId = $(this).data('id');
        var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";

        $.ajax({
            url: "/patients/delete/" + patientId,
            type: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization': 'Bearer ' + token
            },
            success: function(response) {
                alert('Paciente deletado com sucesso.');
                // Opcional: Redirecionar ou atualizar a página, se necessário
                window.location.reload();
            },
            error: function(xhr, status, error) {
                alert('Erro ao deletar paciente.');
            }
        });
    });
}); --}}


</script>

@endsection