<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Models\PatientStatusLog;
use App\Repositories\Contracts\Patients\PatientsStatusRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class PatientsStatusRepository implements PatientsStatusRepositoryInterface
{
    public function __construct(
        private PatientStatusLog $patientStatusLog
    ){}

    public function getAll(string $filter = null): array
    {
        return $this->patientStatusLog
                    ->all()
                    ->toArray();
    }

    public function findOne(string $id): Patient
    {
        return $this->patientStatusLog->findOrFail($id);
    }

    public function create(CreatePatientDTO $createPatientDTO): stdClass
    {
        
    }

    public function update(UpdatePatientDTO $updatePatientDTO): array
    {
        
    }

    public function delete(string $id): voidarray
    {
        
    }

}