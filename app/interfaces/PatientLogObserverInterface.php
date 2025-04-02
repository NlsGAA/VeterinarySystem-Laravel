<?php 

namespace App\Interfaces;

interface PatientLogObserverInterface
{
    public function handle(string $patientId, string $patientStatus);
}