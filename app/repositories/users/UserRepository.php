<?php 

namespace App\Repositories\Users;

use App\Models\User;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Repositories\Users\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User $user
    ){
    }

    public function getAll(Request $filter = null)
    {
        return $this->user->all()->toArray();
    }

    public function findOne(string $id): Model
    {
        return $this->user->findOrFail($id);
    }

    public function create(CreatePatientDTO $createPatientDTO): stdClass
    {
        $patient =  $this->user->create(
            (array) $createPatientDTO
        );

        return (object) $patient->toArray();
    }

    public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null
    {
        $patient = $this->user->find($updatePatientDTO->id);

        if(!$patient) return null;
        
        $patient->update(
            (array) $updatePatientDTO
        );

        return (object) $patient->toArray();
    }

    public function delete(string $id): void
    {
        $this->user->find($id)->delete();
    }
}