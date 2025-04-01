<?php 

namespace App\Interfaces;

interface PatientLogObserverInterface
{
    public function setLog(string $patientId, string $patientStatus);
}