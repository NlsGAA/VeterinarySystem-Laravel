<?php 

namespace App\Services;

use stdClass;
use App\DTO\PatientDTO;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\DTO\Hospitalized\CreateHospitalizedDTO;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use App\Repositories\Hospitalized\HospitalizedRepository;

class PatientsServices
{
    public function __construct(
        private PatientsRepositoryInterface $patientsRepository,
        private HospitalizedRepository $hospitalizedRepository
    ){
    }

    public function index(Request $filter)
    {
        return $this->patientsRepository->getAll($filter);
    }
    public function create(Request $patientPayload)
    {
        $patientDTO = new PatientDTO($patientPayload);
        $patient = $this->patientsRepository->create($patientDTO);
        
        if(!empty($patient) && $patientDTO->motivoCadastro == 2){
            $patientDTO = new CreateHospitalizedDTO($patientPayload, auth()->user()->id);
            $this->hospitalizedRepository->create($patientDTO, $patient->patient_id);
        }

        return $patient;
    }

    public function update(PatientDTO $patientDTO): stdClass|null|bool
    {
        // $patient_hospitalized = $this->hospitalizedRepository->findByPatientId($patientDTO->patient_id);

        // if($patientDTO->motivoCadastro == 2 && !$patient_hospitalized){
            // $this->hospitalizedRepository->create($patientDTO);
        // }
        // if($patientDTO->motivoCadastro != 2 && $patient_hospitalized){
            // $this->hospitalizedRepository->delete($patientDTO->patient_id);
        // }

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