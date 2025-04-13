<?php 

namespace App\Observers;

use App\Interfaces\PatientLogObserverInterface;
use App\Mail\TutorMail;
use App\Models\Patient;
use App\Services\MailService;
use App\Types\Email;
use Illuminate\Contracts\Mail\Mailable;

class TutorEmailObserver implements PatientLogObserverInterface
{
    public function handle(string $patientId, string $patientStatus): void {
        $patientModel = $this->getPatientData($patientId);

        $owner = $patientModel['owner'];
        
        $emailTo = $this->handleEmail($owner['email']);

        $nameTo  = $owner['firstName'] . ' ' . $owner['lastName'];

        $emailContent = $this->handleEmailContent(
            $patientModel['name'],
            $nameTo
        );

        $this->sendEmail(
            $emailTo,
            $nameTo,
            $emailContent
        );
    }

    private function getPatientData(string $patientId): Patient|null {
        return Patient::findWithOwner($patientId);
    }

    private function handleEmail(string $email): Email
    {
        return new Email($email);
    }

    private function handleEmailContent(string $patientName, string $nameTo): TutorMail
    {
        $emailContent = new TutorMail([
            'subject'     => 'Status do Paciente',
            'patientName' => $patientName,
            'ownerName'   => $nameTo,
            // 'message'     => 'O paciente ' . $patientId . ' foi alterado para ' . $patientStatus,
        ]);

        return $emailContent;
    }

    private function sendEmail(
        Email $emailTo,
        string $nameTo,
        Mailable $emailContent
    ): void
    {
        $mailService = new MailService(
            $emailTo,
            $nameTo,
            $emailContent
        );
        
        $mailService->send();
    }
}