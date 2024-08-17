<?php 

namespace App\Services;

use App\DTO\PatientDTO;
use App\Models\Patient;
use App\Repositories\Hospitalized\HospitalizedRepository;
use App\Repositories\PatientsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class PatientsServices
{
    public function __construct(
        private PatientsRepository $patientsRepository,
        private HospitalizedRepository $hospitalizedRepository
    ){
    }

    public function index(Request $filter)
    {
        return $this->patientsRepository->getAll($filter);
    }
    public function create(PatientDTO $patientDTO)
    {
        $patient = $this->patientsRepository->create($patientDTO);
        
        if(!empty($patient) && $patientDTO->motivoCadastro == 2){
            $this->hospitalizedRepository->create($patientDTO, $patient->patient_id);
        }

        return $patient;
    }

    public function update(PatientDTO $patientDTO): stdClass|null
    {
        $patient_hospitalized = $this->hospitalizedRepository->findByPatientId($patientDTO->patient_id);

        if($patientDTO->motivoCadastro == 2 && !$patient_hospitalized){
            $this->hospitalizedRepository->create($patientDTO);
        }
        if($patientDTO->motivoCadastro != 2 && $patient_hospitalized){
            $this->hospitalizedRepository->delete($patientDTO->patient_id);
        }

        return $this->patientsRepository->update($patientDTO);
    }

    public function findOne(string $id): Patient
    {
        return $this->patientsRepository->findOne($id);
    }

    public function delete(string $id)
    {
        return $this->patientsRepository->delete($id);
    }
}