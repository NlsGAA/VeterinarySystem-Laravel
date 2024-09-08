<?php

namespace App\Repositories;

use App\DTO\PatientDTO;
use App\Models\Patient;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

class PatientsRepository extends BaseRepository implements PatientsRepositoryInterface
{
    public function __construct(
        private Patient $patient,
    ){
        parent::__construct($this->patient);
    }
}