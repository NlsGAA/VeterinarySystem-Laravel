<?php

namespace App\Repositories;

use App\DTO\PatientDTO;
use App\Models\HospitalizedPatients;
use App\Models\Patient;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

class PatientsRepository implements PatientsRepositoryInterface
{
    public function __construct(
        private Patient $patient,
        private HospitalizedPatients $hospitalizedPatients
    ){
    }

    public function getAll(Request $filter = null)
    {
        if($filter->statusCode)
        {
            return $this->patient
                        ->where('motivoCadastro', 'like', $filter->statusCode)
                        ->get()
                        ->toArray();
        }

        return $this->patient
                    ->all()
                    ->toArray();
    }

    public function findOne(string $id): Model
    {
        return $this->patient->findOrFail($id);
    }

    public function create(PatientDTO $patientDTO): stdClass
    {
        $patient =  $this->patient->create([
            'nome'              => $patientDTO->nome,
            'raca'	            => $patientDTO->raca,
            'especie'	        => $patientDTO->especie,
            'peso'	            => $patientDTO->peso,
            'tipoPeso'	        => $patientDTO->tipoPeso,
            'coloracao'	        => $patientDTO->coloracao,
            'idade'	            => $patientDTO->idade,
            'tipoIdade'	        => $patientDTO->tipoIdade,
            'procedencia'	    => $patientDTO->procedencia,
            'motivoCadastro'	=> $patientDTO->motivoCadastro,
            'user_id'	        => $patientDTO->user_id,
            'image'             => $patientDTO->image,
        ]);

        return (object) $patient->toArray();
    }

    public function update(PatientDTO $patientDTO): stdClass|null
    {
        $patient = $this->findOne($patientDTO->patient_id)->update([
            'nome'              => $patientDTO->nome,
            'raca'	            => $patientDTO->raca,
            'especie'	        => $patientDTO->especie,
            'peso'	            => $patientDTO->peso,
            'tipoPeso'	        => $patientDTO->tipoPeso,
            'coloracao'	        => $patientDTO->coloracao,
            'idade'	            => $patientDTO->idade,
            'tipoIdade'	        => $patientDTO->tipoIdade,
            'procedencia'	    => $patientDTO->procedencia,
            'motivoCadastro'	=> $patientDTO->motivoCadastro,
            'image'             => $patientDTO->image,
            'updated_by'        => $patientDTO->user_id,
        ]);

        return (object) $patient;
    }

    public function delete(string $id): void
    {
        $this->patient->find($id)->delete();
    }
}