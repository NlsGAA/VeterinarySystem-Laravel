<?php 

namespace App\Services;

use App\DTO\OwnersDTO\OwnersDTO;
use App\Repositories\Owners\OwnersRepositoryInterface;
use Illuminate\Http\Request;

class OwnersServices
{
    public function __construct(
        private OwnersRepositoryInterface $ownersRepository
    ){}

    public function index()
    {
        return $this->ownersRepository->getAll();
    }
    
    private function create(OwnersDTO $ownersDTO)
    {
        return $this->ownersRepository->create($ownersDTO);
    }
    
    public function update(Request $ownerPayload)
    {
        $owner = $this->ownersRepository->findBy(
            'cpf',
            $ownerPayload->cpf
        );

        $ownerDto = new OwnersDTO(
            $ownerPayload, 
            $owner->id ?? null
        );

        if(empty($owner)) {
            return $this->create($ownerDto);
        }
        
        return $this->ownersRepository->update($ownerDto);
    }

    public function delete(string $id)
    {
        return $this->ownersRepository->delete($id);
    }
}