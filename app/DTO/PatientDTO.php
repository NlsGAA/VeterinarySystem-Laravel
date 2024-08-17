<?php 

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDTO
{
    public $user_id;
    public ?string $patient_id = null;
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
    public ?string $image = null;
    public int $situationId;
    public int $doctorId;

    public function __construct(Request $request)
    {
        $this->user_id              = auth()->user()->id;
        $this->patient_id           = $request->id ?? null;
        $this->nome                 = $request->nome;
        $this->raca                 = $request->raca;
        $this->especie              = $request->especie;
        $this->peso                 = $request->peso;
        $this->tipoPeso             = $request->tipoPeso;
        $this->coloracao            = $request->coloracao;
        $this->idade                = $request->idade;
        $this->tipoIdade            = $request->tipoIdade;
        $this->procedencia          = $request->procedencia;
        $this->motivoCadastro       = $request->motivoCadastro;
        $this->situationId          = $request->situacaoInternacao;
        $this->doctorId             = $request->drResponsavel;
        
        if(isset($request->image) && !empty($request->image)){
            if ($request->hasFile('image') && $request->file('image')->isValid()) {
                $requestImage = $request->image;
                $extension = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalname() . strtotime("now") . '.' . $extension);
                $requestImage->move(public_path('img/patientsImages'), $imageName);
                $this->image = $imageName;
            };
        }
    }
}