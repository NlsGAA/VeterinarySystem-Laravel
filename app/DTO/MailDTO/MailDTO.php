<?php 

namespace App\DTO\MailDTO;

class MailDTO
{

    private $emailTo;
    private $nameTo;
    private $mailable;

    public function __construct(
        $emailTo,
        $nameTo,
        $mailable,
    ) {
        $this->emailTo   = $emailTo;
        $this->nameTo    = $nameTo;
        $this->mailable  = $mailable;
    }


    public function getEmailTo(): string
    {
        return $this->emailTo;
    }

    public function getNameTo(): string
    {
        return $this->nameTo;
    }

    public function getMailable()
    {
        return $this->mailable;
    }
}