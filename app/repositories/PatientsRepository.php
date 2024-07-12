<?php

namespace App\Repositories;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Models\Patient;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

class PatientsRepository implements PatientsRepositoryInterface
{
    public function __construct(
        private Patient $patient
    ){}

    public function getAll(Request $filter)
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
        $patient =  $this->patient->create(
            (array) $createPatientDTO
        );

        return (object) $patient->toArray();
    }

    public function update(UpdatePatientDTO $updatePatientDTO): Patient
    {
        return $this->patient->find($updatePatientDTO->id);
        // if(!$patient = $this->patient->find($updatePatientDTO->id))
        // {
        //     return null;
        // }

        // $patient->update(
        //     (array) $updatePatientDTO
        // );

        // return (object) $patient->toArray();
    }

    public function delete(string $id): void
    {
        $this->patient->find($id)->delete();
    }
}