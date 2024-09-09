@extends('layouts.layout')

@section('title', 'Criando dono')

@section('content')

<div class="container mt-5">
    <div class="col-md-4 offset-md-6 shadow-lg bg-white p-2 rounded d-inline-block">
        <form method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row p-3 w-100">
                <div class="mb-2">
                    <div class="">
                        <label for="nome" class="form-label fw-bold">Nome:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control w-100" placeholder="Nome" name="firstName" required>
                    </div>
                    <div class="">
                        <label for="raca" class="form-label fw-bold">Sobrenome:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control w-100" placeholder="Sobrenome" name="lastName" required>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="">
                        <label for="especie" class="form-label fw-bold">Email:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control w-100" placeholder="Email" name="email" required>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="">
                        <label for="especie" class="form-label fw-bold">Cpf:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control w-100" maxlength="11" placeholder="Cpf" name="cpf" required>
                    </div>
                </div>



                <div class="mb-2">
                    <div class="">
                        <label for="coloracao" class="form-label fw-bold">Endereço:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control w-100" placeholder="Endereço" name="address" required>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="">
                        <label for="coloracao" class="form-label fw-bold">Celular:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control w-100" maxlength="11" placeholder="Celular" name="cellphone" required>
                    </div>
                </div>
                <div class="mb-2">
                    <div class="">
                        <label for="coloracao" class="form-label fw-bold">Telefone Residencial:<span class="text-danger">*</span></label>
                        <input type="text" class="form-control w-100" maxlength="11" placeholder="Telefone Residencial" name="cellphone2" required>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="col-md-12">
                        <input class="btn btn-success" type="submit" value="Cadastrar">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('form').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var token = "{{ auth()->user()->createToken('TokenName')->plainTextToken }}";

            $.ajax({
                url: "{{ route('owners.update') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization': 'Bearer ' + token
                },
                success: function(response) {
                    window.location.href = "{{ route('home') }}";
                },
                error: function(response) {
                    alert('Erro ao cadastrar dono.');
                }
            });
        });
    });
</script>

@endsection