<?php

namespace App\Services;

use App\Types\Email;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class MailService
{
    public function __construct(
        public Email $emailTo,
        public string $nameTo,
        public Mailable $emailContent,
    ){
    }


    public function send(): void
    {
        Mail::to(
            $this->emailTo->get(),
            $this->nameTo
        )
        ->send($this->emailContent);
    }

}