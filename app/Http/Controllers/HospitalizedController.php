<?php

namespace App\Http\Controllers;

use App\DTO\Hospitalized\CreateHospitalizedDTO;
use App\DTO\PatientDTO;
use App\Http\Controllers\Controller;
use App\Services\HospitalizedServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class HospitalizedController extends Controller
{
    public function __construct(
        protected HospitalizedServices $hospitalizedServices
    ){}

    public function store(Request $request)
    {
        try {
            $patient = $this->hospitalizedServices->create(new CreateHospitalizedDTO($request));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente cadastrado com sucesso!", $patient, 201);
    }

    public function index(Request $filter)
    {
        try {
            $patients = $this->hospitalizedServices->index($filter);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Pacientes recuperados com sucesso!", $patients);
    }

    public function show(string $id)
    {
        try {
            $patient = $this->hospitalizedServices->findOne($id)->toArray();
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente recuperado com sucesso!", $patient);
    }

    public function delete(string $id)
    {
        try {
            $patient = $this->hospitalizedServices->delete($id);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente deletado com sucesso!", $patient);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $patient = $this->hospitalizedServices->update($request, $id);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente atualizado com sucesso!", $patient);
    }
}
