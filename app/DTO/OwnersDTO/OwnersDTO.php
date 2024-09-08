<?php 

namespace App\DTO\OwnersDTO;

use Illuminate\Http\Request;

class OwnersDTO
{
    public ?string $id;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $cpf;
    public ?string $email;
    public ?string $cellphone;
    public ?string $cellphone2 = null;
    public ?string $address = null;
    
    public function __construct(Request $ownersPayload, $ownerId = null)
    {
        $this->id           = $ownerId;
        $this->firstName    = $ownersPayload->firstName;
        $this->lastName     = $ownersPayload->lastName;
        $this->cpf          = $ownersPayload->cpf;
        $this->email        = $ownersPayload->email;
        $this->cellphone    = $ownersPayload->cellphone;
        $this->cellphone2   = $ownersPayload->cellphone2;
        $this->address      = $ownersPayload->address;
    }
}