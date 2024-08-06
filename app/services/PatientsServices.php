<?php 

namespace App\Services;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Models\Patient;
use App\Repositories\PatientsRepository;
use Illuminate\Http\Request;
use stdClass;

class PatientsServices
{
    public function __construct(
        private PatientsRepository $patientsRepository
    ){
    }

    public function index(Request $filter)
    {
        return $this->patientsRepository->getAll($filter);
    }
    public function create(CreatePatientDTO $createPatientDTO)
    {
        $patient = $this->patientsRepository->create($createPatientDTO);
        
        if(!empty($patient) && $createPatientDTO->motivoCadastro == 2){
            $this->patientsRepository->hospitalizedCreate($createPatientDTO, $patient->patient_id);
        }

        return $patient;
    }

    public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null
    {
        return $this->patientsRepository->update($updatePatientDTO);
    }

    public function findOne(string $id): Patient
    {
        return $this->patientsRepository->findOne($id);
    }

    public function delete(string $id)
    {
        $this->patientsRepository->delete($id);
    }
}