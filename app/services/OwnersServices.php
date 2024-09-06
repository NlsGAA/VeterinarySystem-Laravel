<?php 

namespace App\Services;

use App\DTO\OwnersDTO\OwnersDTO;
use App\Repositories\Owners\OwnersRepository;

class OwnersServices
{
    public function __construct(
        private OwnersRepository $ownersRepository
    ){}

    public function index()
    {
        return $this->ownersRepository->getAll();
    }
    
    private function create(OwnersDTO $ownersDTO)
    {
        return $this->ownersRepository->create($ownersDTO);
    }
    
    public function update(OwnersDTO $ownersDTO)
    {
        $owner = $this->ownersRepository->findBy('cpf', $ownersDTO->cpf);
        if(empty($owner))
            return $this->create($ownersDTO);

        return $this->ownersRepository->update($ownersDTO, $owner->id);
    }

    public function delete(string $id)
    {
        return $this->ownersRepository->delete($id);
    }
}