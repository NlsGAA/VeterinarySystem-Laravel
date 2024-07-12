<?php 

namespace App\Services;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Models\Patient;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

class PatientsServices
{
    public function __construct(
        private PatientsRepositoryInterface $patientsRepository
    ){
    }

    public function index(Request $filter)
    {
        return $this->patientsRepository->getAll($filter);
    }
    public function create(CreatePatientDTO $createPatientDTO)
    {
        return $this->patientsRepository->create($createPatientDTO);
    }

    public function update(UpdatePatientDTO $updatePatientDTO): Patient
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