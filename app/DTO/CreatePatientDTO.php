<?php 

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreatePatientDTO
{
    public $user_id;
    public string $nome;
    public string $raca;
    public string $especie;
    public string $peso;
    public int $tipoPeso;
    public string $coloracao;
    public int $idade;
    public int $tipoIdade;
    public string $procedencia;
    public string $motivoCadastro;
    public string $image;

    public function __construct(Request $request, $logged_user_id)
    {
        $this->user_id      = $logged_user_id;
        $this->nome         = $request->nome;
        $this->raca         = $request->raca;
        $this->especie      = $request->especie;
        $this->peso         = $request->peso;
        $this->tipoPeso     = $request->tipoPeso;
        $this->coloracao    = $request->coloracao;
        $this->idade        = $request->idade;
        $this->tipoIdade    = $request->tipoIdade;
        $this->procedencia  = $request->procedencia;
        $this->motivoCadastro  = $request->motivoCadastro;
        
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalname() . strtotime("now") . '.' . $extension);
            $requestImage->move(public_path('img/patientsImages'), $imageName);
            $this->image = $imageName;
        };
    }
}