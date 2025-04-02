<?php 

namespace App\Observers;

use App\Interfaces\PatientLogObserverInterface;
use App\Models\PatientStatusLog;
use App\Models\Reason;
use Illuminate\Support\Facades\Auth;

class PatientLogObserver implements PatientLogObserverInterface
{
    public function handle(string $patientId, string $patientStatus): void {
        $lastLog = $this->getLastLog($patientId);

        if($lastLog){
            $logMessage = str_replace(
                'deu entrada para',
                'obteve baixa em',
                $lastLog->message
            );

            $this->setLog(
                $patientId,
                $patientStatus,
                $logMessage
            );
        }

        $this->setLog($patientId, $patientStatus);
    }

    private function setLog(
        string $patientId,
        string $patientStatus,
        ?string $logMessage = null
    ): void {
        if(!$logMessage){
            $logMessage = $this->getMessage($patientStatus);
        }

        PatientStatusLog::create([
            'status' => $patientStatus,
            'patient_id' => $patientId,
            'user_id' => Auth::user()->id,
            'message' => $logMessage,
        ]);
    }

    private function getMessage(string $status): string
    {
        $reason = Reason::where('id', $status)->first();

        $logMessage = 'Paciente deu entrada para ' . $reason->description;

        return $logMessage;
    }

    private function getLastLog(string $patientId): ?PatientStatusLog {
        $patientLogModel = new PatientStatusLog();

        return $patientLogModel->where('patient_id', $patientId)
            ->latest()
            ->first();
    }
}