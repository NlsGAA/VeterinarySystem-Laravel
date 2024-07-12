<?php 

namespace App\DTO;

use Illuminate\Http\Request;

class UpdatePatientDTO
{
    public string $id;
    public string $nome;
    public string $raca;
    public string $especie;
    public float $peso;
    public int $tipoPeso;
    public string $coloracao;
    public int $idade;
    public int $tipoIdade;
    public string $procedencia;

    public function __construct(Request $request)
    {
        $this->id           = $request->id;
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