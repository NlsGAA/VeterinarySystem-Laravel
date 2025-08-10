<?php

namespace App\Services;

use App\Interfaces\PatientLogObserverInterface;

class BaseService
{
    private array $observers = [];

    /**
     * Add observers
     * TODO: create a base service to implements
     * all methods that any service can have, like observers
     *
     * @param PatientLogObserverInterface $observer
     * @return void
     */
    public function addObservers(PatientLogObserverInterface $observer): void {
        $this->observers[] = $observer;
    }

    /**
     * Notify observers
     * TODO: create a base service to implements
     * all methods that any service can have, like observers
     *
     * @param string $patientId
     * @param string $patientStatus
     * @return void
     */
    public function notifyObservers(string $patientId, string $patientStatus): void {
        foreach($this->observers as $observer) {
            $observer->handle($patientId, $patientStatus);
        }
    }
}