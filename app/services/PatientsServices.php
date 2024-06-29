<?php 

namespace App\Services;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use stdClass;

class PatientsServices
{
    private function __construct(
        private PatientsRepositoryInterface $patientsRepository
    ){
    }

    public function index(string $filter = null): array
    {
        return $this->patientsRepository->getAll($filter);
    }
    public function create(CreatePatientDTO $createPatientDTO): stdClass
    {
        return $this->patientsRepository->create($createPatientDTO);
    }

    public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null
    {
        return $this->patientsRepository->update($updatePatientDTO);
    }

    public function findOne(string $id): stdClass|null
    {
        return $this->patientsRepository->findOne($id);
    }

    public function delete(string $id): void
    {
        $this->patientsRepository->delete($id);
    }
}