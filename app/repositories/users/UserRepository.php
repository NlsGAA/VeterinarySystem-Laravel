<?php 

namespace App\Repositories\Users;

use App\Models\User;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Users\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model(){
        return User::class;
    }
    public function __construct(
        private User $user
    ){
        parent::__construct($this->user);
    }
}