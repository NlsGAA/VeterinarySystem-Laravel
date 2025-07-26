<?php

namespace App\Http\Controllers;

use App\DTO\PatientDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\PatientsServices;
use App\Http\Controllers\Controller;
use App\Observers\PatientLogObserver;
use App\Observers\TutorEmailObserver;
use App\Http\Resources\PatientResource;

class PatientsController extends Controller
{
    public function __construct(
        protected PatientsServices $patientsServices
    ){}

    public function store(Request $request): JsonResponse
    {
        try {
            $patient = $this->patientsServices->create($request);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente cadastrado com sucesso!", $patient, 201);
    }

    public function index(): JsonResponse
    {
        try {
            $patients = $this->patientsServices->index();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Pacientes recuperados com sucesso!", $patients);
    }

    public function show(string $id): JsonResponse
    {
        try {
            $patient = $this->patientsServices->findOne($id);
            $patientResource = new PatientResource($patient);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente recuperado com sucesso!", $patientResource);
    }

    public function destroy($id): JsonResponse
    {
        try {
            $this->patientsServices->delete($id);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente deletado com sucesso!", null);
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $this->patientsServices->addObservers(new PatientLogObserver());
            $this->patientsServices->addObservers(new TutorEmailObserver());
            $this->patientsServices->update(new PatientDTO($request));
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente atualizado com sucesso!", null);
    }

    public function dashboard(?Request $filterBy): JsonResponse
    {
        try {
            $patients = $this->patientsServices->findAllPatients($filterBy);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Pacientes recuperados com sucesso!", $patients);
    }
}
