<?php

namespace App\Repositories\Patients;

use App\Models\Patient;
use App\Models\PatientStatusLog;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\Patients\PatientsStatusRepositoryInterface;

class PatientsStatusRepository extends BaseRepository implements PatientsStatusRepositoryInterface
{
    public function __construct(
        private PatientStatusLog $patientStatusLog
    ){}

    public function getAll(?string $filter = null): array
    {
        return $this->patientStatusLog->all()->toArray();
    }

    public function findOne(string $id): Patient
    {
        return $this->patientStatusLog->findOrFail($id);
    }
}