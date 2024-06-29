<?php

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Models\Patient;
use App\Repositories\Contracts\PatientsRepositoryInterface;

class PatientsRepository implements PatientsRepositoryInterface
{
    public function __construct(
        private Patient $patient
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->patient
                    ->all()
                    ->toArray();
    }

    public function findOne(string $id): stdClass|null
    {
        $patient = $this->patient->find($id);
        if(!$patient){
            return null;
        }

        return (object) $patient->toArray();
    }

    public function create(CreatePatientDTO $createPatientDTO): stdClass
    {
        $patient =  $this->patient->create(
            (array) $createPatientDTO
        );

        return (object) $patient->toArray();
    }

    public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null
    {
        if(!$patient = $this->patient->find($updatePatientDTO->id))
        {
            return null;
        }

        $patient->update(
            (array) $updatePatientDTO
        );

        return (object) $patient->toArray();
    }

    public function delete(string $id): void
    {
        $this->patient->findOrFail($id)->delete();
    }
}