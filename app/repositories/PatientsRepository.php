<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\PatientsRepositoryInterface;

class PatientsRepository extends BaseRepository implements PatientsRepositoryInterface
{
    public function __construct(
        private Patient $patient,
    ){
        parent::__construct($this->patient);
    }

    public function findMine()
    {
        return auth()->user()->patients;
    }
}