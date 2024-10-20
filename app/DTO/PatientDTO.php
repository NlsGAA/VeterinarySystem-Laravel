<?php 

namespace App\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientDTO
{
    public $user_id;
    public ?string $id = null;
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
    public ?string $image;
    public int $situationId;
    public int $doctorId;
    public int $owner_id;

    public function __construct(Request $request, $patientId = null)
    {
        $this->user_id              = auth()->user()->id;
        $this->id                   = $request->id ?? $patientId;
        $this->nome                 = $request->name;
        $this->raca                 = $request->breed;
        $this->especie              = $request->species;
        $this->peso                 = $request->weight;
        $this->tipoPeso             = $request->weightType;
        $this->coloracao            = $request->color;
        $this->idade                = $request->age;
        $this->tipoIdade            = $request->ageType;
        $this->procedencia          = $request->origin;
        $this->motivoCadastro       = $request->reason;
        $this->owner_id             = $request->owner;

        $imageFile = ($request->file('image')) ?? null;
        if(isset($imageFile) && !empty($imageFile)) {
            $filesName = $imageFile['name'];
            $tmpName = $imageFile['tmp_name'];
            $filesToJson = [];

            foreach($filesName as $key => $fileName)
            {
                $extension = pathinfo($fileName, PATHINFO_EXTENSION);
                $fileUniqName = uniqid() . '.' . $extension;
                move_uploaded_file($tmpName[$key], 'img/patientsImages/'.$fileUniqName);
                $filesToJson[] = $fileUniqName;
            }
            $this->image = json_encode($filesToJson);
        }
    }
}