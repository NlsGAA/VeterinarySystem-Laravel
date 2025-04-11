<?php 

namespace App\Observers;

use App\Interfaces\PatientLogObserverInterface;
use App\Mail\TutorMail;
use App\Services\MailService;
use App\Types\Email;

class TutorEmailObserver implements PatientLogObserverInterface
{
    public function handle(string $patientId, string $patientStatus): void {
        $emailTo = new Email('nicolas.americo@yahoo.com.br');
        $nameTo  = 'Nicolas';

        $emailContent = new TutorMail([
            'subject'   => 'Status do Paciente',
            'message'   => 'O paciente ' . $patientId . ' foi alterado para ' . $patientStatus,
        ]);

        $mailService = new MailService($emailTo, $nameTo, $emailContent);
        
        $mailService->send();

        dd('enviou email');
    }
}