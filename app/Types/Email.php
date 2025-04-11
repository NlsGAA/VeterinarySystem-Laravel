<?php

namespace App\Types;

class Email
{
    private string $email;

    public function __construct(string $email){
        $this->validate($email);
    }

    private function validate(string $email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            throw new \InvalidArgumentException(
                'Não foi possível notificar o tutor, email inválido',
                400
            );
        }

        $this->email = $email;
    }

    public function get(): string
    {
        return $this->email;
    }
}