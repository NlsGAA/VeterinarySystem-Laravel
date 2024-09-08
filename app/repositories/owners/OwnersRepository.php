<?php 

namespace App\Repositories\Owners;

use App\Models\Owners;
use App\Repositories\Contracts\BaseRepository;

class OwnersRepository extends BaseRepository implements OwnersRepositoryInterface
{
    public function __construct(
        private Owners $owners
    ){
        parent::__construct($this->owners);
    }
}