<?php 

namespace App\DTO\OwnersDTO;

use Illuminate\Http\Request;

class OwnersDTO
{
    public ?string $firstName;
    public ?string $lastName;
    public ?string $cpf;
    public ?string $email;
    public ?string $cellphone;
    public ?string $cellphone2 = null;
    public ?string $address = null;
    
    public function __construct(Request $request)
    {
        $this->firstName    = $request->firstName;
        $this->lastName     = $request->lastName;
        $this->cpf          = $request->cpf;
        $this->email        = $request->email;
        $this->cellphone    = $request->cellphone;
        $this->cellphone2   = $request->cellphone2;
        $this->address      = $request->address;
    }
}