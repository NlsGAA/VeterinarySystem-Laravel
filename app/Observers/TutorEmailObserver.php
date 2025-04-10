<?php 

namespace App\Observers;

use App\Interfaces\PatientLogObserverInterface;
use App\Mail\TutorMail;
use Illuminate\Support\Facades\Mail;

class TutorEmailObserver implements PatientLogObserverInterface
{
    public function handle(string $patientId, string $patientStatus): void {
        $sent = Mail::to('nicolas.americo@yahoo.com.br', 'Nicolas')->send(new TutorMail([
            'fromName' => 'Hospital Veterinário',
            'fromEmail' => 'N0BqW@example.com',
            'subject' => 'Tutor Mail',
            'message' => 'Hello World!',
        ]));

        dd('email enviado', $sent);
    }
}