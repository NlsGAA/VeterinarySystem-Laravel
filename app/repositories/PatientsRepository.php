<?php

namespace App\Repositories;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
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

    public function create(CreatePatientDTO $createPatientDTO): stdClass
    {
        $patient =  $this->patient->create([
            'nome'	 => $createPatientDTO->nome,
            'raca'	 => $createPatientDTO->raca,
            'especie'	 => $createPatientDTO->especie,
            'peso'	 => $createPatientDTO->peso,
            'tipoPeso'	 => $createPatientDTO->tipoPeso,
            'coloracao'	 => $createPatientDTO->coloracao,
            'idade'	 => $createPatientDTO->idade,
            'tipoIdade'	 => $createPatientDTO->tipoIdade,
            'procedencia'	 => $createPatientDTO->procedencia,
            'motivoCadastro'	 => $createPatientDTO->motivoCadastro,
            'user_id'	 => $createPatientDTO->user_id,
            'image' => $createPatientDTO->image,
        ]);

        return (object) $patient->toArray();
    }

    public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null
    {
        $patient = $this->patient->find($updatePatientDTO->id);

        if(!$patient) return null;
        
        $patient->update(
            (array) $updatePatientDTO
        );

        return (object) $patient->toArray();
    }

    public function delete(string $id): void
    {
        $this->patient->find($id)->delete();
    }

    public function hospitalizedCreate(CreatePatientDTO $createPatientDTO, int $patient_id){
        $hospitalizedPatient = $this->hospitalizedPatients->create([
            'patient_id'    => $patient_id,
            'doctor_id'     => $createPatientDTO->drResponsavel,
            'situation_id'  => $createPatientDTO->situacaoInternacao,
            'updated_by'    => $createPatientDTO->user_id
        ]);

        return (object) $hospitalizedPatient->toArray();
    }
}