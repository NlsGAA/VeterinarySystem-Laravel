<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PatientStatusLog;

class LogsController extends Controller
{
    public function patient(string $id)
    {
        try {
            $patientLogs = PatientStatusLog::where('patient_id', 'like', $id)->get();
            
            if(!$patientLogs) {
                return response()->json([
                    'message' => 'Paciente não possui nenhuma movimentação!',
                    'status'  => 'success'
                ], 200);
            }

            foreach ($patientLogs as $log) {
                $log->created_at_formatted = $log->created_at->format('d/m/Y H:i:s');
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ocorreu um erro inesperado ao resgatar os logs do paciente',
                'status'  => 'error'
            ], 500);
        }

        return response()->json([
            'logs'    => $patientLogs,
            'status'  => 'success',
            'message' => 'Logs resgatados com sucesso!'
        ], 200);
    }
}
