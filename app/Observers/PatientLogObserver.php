<?php 

namespace App\Observers;

use App\Interfaces\PatientLogObserverInterface;
use App\Models\PatientStatusLog;
use App\Models\Reason;
use Illuminate\Support\Facades\Auth;

class PatientLogObserver implements PatientLogObserverInterface
{
    public function setLog(string $patientId, string $patientStatus): void {
        $logMessage = $this->getMessage($patientStatus);

        $patientLogModel = new PatientStatusLog();

        $patientLogModel->create([
            'status' => $patientStatus,
            'patient_id' => $patientId,
            'user_id' => Auth::user()->id,
            'message' => $logMessage,
        ]);
    }

    private function getMessage(string $status)
    {
        $reason = Reason::where('id', $status)->first();

        return match ($status) {
            '1' => 'Paciente deu entrada para ' . $reason->description,
            '2' => 'Paciente deu entrada para ' . $reason->description,
            '3' => 'Paciente deu entrada para ' . $reason->description
        };
    }
}