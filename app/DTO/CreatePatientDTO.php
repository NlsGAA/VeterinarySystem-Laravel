<?php 

namespace App\DTO;

use Illuminate\Http\Request;

class CreatePatientDTO
{

    private string $nome;
    private string $raca;
    private string $especie;
    private float $peso;
    private int $tipoPeso;
    private string $coloracao;
    private int $idade;
    private int $tipoIdade;
    private string $procedencia;

    public function __construct(Request $request)
    {
        $this->nome         = $request->nome;
        $this->raca         = $request->raca;
        $this->especie      = $request->especie;
        $this->peso         = $request->peso;
        $this->tipoPeso     = $request->tipoPeso;
        $this->coloracao    = $request->coloracao;
        $this->idade        = $request->idade;
        $this->tipoIdade    = $request->tipoIdade;
        $this->procedencia  = $request->procedencia;
    }
}