<?php 

namespace App\Repositories\Hospitalized;

use App\Repositories\Contracts\BaseRepositoryInterface;

interface HospitalizedRepositoryInterface extends BaseRepositoryInterface
{
    public function findByPatientId($patientId);
}