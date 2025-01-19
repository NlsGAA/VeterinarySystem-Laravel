<?php 

namespace App\Services;

use stdClass;
use App\DTO\PatientDTO;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\DTO\Hospitalized\CreateHospitalizedDTO;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use App\Repositories\Hospitalized\HospitalizedRepositoryInterface;

class PatientsServices
{
    public function __construct(
        private PatientsRepositoryInterface $patientsRepository,
        private HospitalizedRepositoryInterface $hospitalizedRepository
    ){
    }

    public function index()
    {
        return $this->patientsRepository->getAll();
    }
    public function create(Request $patientPayload)
    {
        $patientDTO = new PatientDTO($patientPayload);
        $patient = $this->patientsRepository->create($patientDTO);
        
        if(!empty($patient) && $patientDTO->reason == 2){
            $this->createHospitalization($patientPayload, $patient->id);
        }

        return $patient;
    }

    public function update(PatientDTO $patientDTO): stdClass|null|bool
    {
        $patientHospitalized = $this->hospitalizedRepository->findByPatientId($patientDTO->id);

        if($patientDTO->reason == 2 && !$patientHospitalized){
            $this->hospitalizedRepository->create($patientDTO);
        }
        if($patientDTO->reason != 2 && $patientHospitalized){
            $this->hospitalizedRepository->delete($patientDTO->id);
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

    private function createHospitalization($patientPayload, int $patientId)
    {
        $patientDTO = new CreateHospitalizedDTO($patientPayload, $patientId);
        return $this->hospitalizedRepository->create($patientDTO);
    }

    public function findAllPatients($filterParam): mixed
    {
        return $this->patientsRepository->findAllPatients($filterParam);
    }
}