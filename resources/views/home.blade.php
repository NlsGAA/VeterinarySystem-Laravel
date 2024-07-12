@extends('layouts.layout')
@section('title', 'VetSystem')

@section('content')

@auth
    <x-filter-bar></x-filter-bar>

    <div id="card-animals" class="row col-md-6">
            @if($search)
                <h5> Buscando por: {{ $search }} </h5>
            @else
                <h5> Veja todos os registros: </h5>
            @endif
            @foreach($registros as $registro)
                <div class="card col-md-3">
                    <img src="img/fichas/{{ $registro->image }}" class="card-img-top" alt="imagem de: {{ $registro->nome }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $registro->nome }}</h5>
                        <p class="card-text">Alguma informação</p>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Raça: {{ $registro->raca }} <li>
                    <li class="list-group-item">Peso: {{ $registro->peso }}
                        @if(($registro->tipoPeso) === 0)
                            Kilos
                        @else
                            Gramas
                        @endif
                        <li>
                    <li class="list-group-item">Idade: {{ $registro->idade }}
                        @if(($registro->tipoIdade) === 0)
                            Anos
                        @else
                            Meses
                        @endif
                    <li>
                    </ul>
                    <div class="card-body">
                        <a href="/fichaTecnica/{{ $registro->id }}" class="card-link">Detalhado</a>
                    </div>
                </div>
            @endforeach
            @if (count($registros) == 0 && $search)
                <p>Não foi possível encontrar nenhum registro com {{ $search }}! Clique <a href="/">aqui</a> para ver todos</p>
            @elseif (count($registros) == 0)
                <p>Não há nenhum registro disponível</p>
            @endif
    </div>
@endauth

@endsection