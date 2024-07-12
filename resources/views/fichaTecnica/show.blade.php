@extends('layouts.layout')

@section('title', $animalsDetails->nome)

@section('content')

    <div class="col-md-11 offset-md-1 info-animal">
        <div class="row">
            <div id="image-container" class="col-md-6">
                <h1>{{$animalsDetails->nome}}</h1>
                <img src="/img/fichas/{{ $animalsDetails->image }}" alt="Image from {{$animalsDetails->nome}}" class="image-fluid">
            </div>
            <div id="info-container" class="col-md-6">

                <h6>Raça:</h6>
                <p>{{$animalsDetails->raca}}</p>
                <hr>
                
                <h6>Espécie:</h6>
                <p>{{$animalsDetails->especie}}</p>
                <hr>

                <h6>Peso:</h6>
                <p>{{$animalsDetails->peso}}
                    @if(($animalsDetails->tipoPeso) === 0)
                        Kilos
                    @else
                        Gramas
                    @endif
                </p>
                <hr>

                <h6>Coloração:</h6>
                <p>{{$animalsDetails->coloracao}}</p>
                <hr>

                <h6>Idade:</h6>
                <p>{{$animalsDetails->idade}} 
                    @if(($animalsDetails->tipoIdade) === 0)
                        Anos
                    @else
                        Meses
                    @endif
                </p>
                <hr>

                <h6>Procedência:</h6>
                <p>{{$animalsDetails->procedencia}}</p>
                <hr>

                <h6>Status do paciente:</h6>
                @switch($animalsDetails->motivoCadastro)
                    @case(1)
                        <p>Serviços gerais</p>
                        @break
                    @case(2)
                        <p>Internamento</p>
                        @break
                    @case(3)
                        <p>Consulta</p>
                        @break
                    @default
                        <p>Status do paciente não definido</p>
                @endswitch
                <hr>
                
                <span><h6>Médico responsável:</h6> {{ $cardOwner['name'] }}</span>

            </div>
        </div>
    </div>



@endsection