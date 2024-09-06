<?php 

namespace App\Repositories\Owners;

use App\DTO\OwnersDTO\OwnersDTO;
use App\Models\Owners;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class OwnersRepository implements OwnersRepositoryInterface
{
    public function __construct(
        private Owners $owners
    ){}

    public function getAll(Request $filter = null)
    {
        return $this->owners->all();
    }

    public function findOne(string $id): Model
    {
        return $this->owners->findOrFail($id);
    }

    public function findBy(string $column, string $value)
    {
        return $this->owners->where($column, $value)->first();
    }

    public function create(OwnersDTO $ownersDTO)
    {
        $owner = $this->owners->create([
            'firstName'     => $ownersDTO->firstName,
            'lastName'      => $ownersDTO->lastName,
            'cpf'           => $ownersDTO->cpf,
            'email'         => $ownersDTO->email,
            'cellphone'     => $ownersDTO->cellphone,
            'cellphone2'    => $ownersDTO->cellphone2,
            'address'       => $ownersDTO->address,
            'created_at'    => now()
        ]);

        if(!$owner)
            return 'Não foi possível criar dono';
        
        return $owner;
    }

    public function update(OwnersDTO $ownersDTO, int $ownerId)
    {
        $owner = $this->owners->find($ownerId)->update([
            'firstName'     => $ownersDTO->firstName,
            'lastName'      => $ownersDTO->lastName,
            'cpf'           => $ownersDTO->cpf,
            'email'         => $ownersDTO->email,
            'cellphone'     => $ownersDTO->cellphone,
            'cellphone2'    => $ownersDTO->cellphone2,
            'address'       => $ownersDTO->address,
            'updated_at'    => now()
        ]);

        if(!$owner)
            return 'Não foi possível atualizar dono';
        
        return $owner;
    }

    public function delete(string $id): void
    {
        $this->owners->find($id)->delete();
    }
}