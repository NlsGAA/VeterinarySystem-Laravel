@props([
    'patientId' => null, 'patientImage' => null, 'patientName' => null,
    'patientBreed' => null, 'patientWeight' => 0, 'patientWeightType' => null,
    'patientOld' => 0, 'patientOldType' => 0
])

'<div class="card col-md-3" id="patient-card-atr">
    <img src="img/fichas/{{ $patientImage }}" class="card-img-top" alt="imagem de: {{ $patientName }}">
    <div class="card-body">
        <h5 class="card-title">{{ $patientName }}</h5>
        <p class="card-text">Alguma informação</p>
    </div>
    <ul class="list-group list-group-flush">
    <li class="list-group-item">Raça: {{ $patientBreed }} <li>
    <li class="list-group-item">Peso: {{ $patientWeight }}
        @if(($patientWeightType) === 0)
            Kilos
        @else
            Gramas
        @endif
        <li>
    <li class="list-group-item">Idade: {{ $patientOld }}
        @if(($patientOldType) === 0)
            Anos
        @else
            Meses
        @endif
    <li>
    </ul>
    <div class="card-body">
        <a href="/fichaTecnica/{{ $patientId }}" class="card-link">Detalhado</a>
    </div>
</div>'