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

    /**
     * Display a list of all owners
     *
     * @return array
     */
    public function index()
    {
        return $this->ownersRepository->getAll()->toArray();
    }

    /**
     * Create a new owner
     *
     * @param OwnersDTO $ownersDTO
     * @return array
     */
    private function create(OwnersDTO $ownersDTO)
    {
        return $this->ownersRepository->create($ownersDTO);
    }

    /**
     * Update a owner
     * TODO: refactor this
     *
     * @param Request $ownerPayload
     * @return array
     */
    public function update(Request $ownerPayload)
    {
        $owner = $this->ownersRepository->findBy(
            'cpf',
            '=',
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

    /**
     * Delete a owner
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id)
    {
        return $this->ownersRepository->delete($id);
    }
}