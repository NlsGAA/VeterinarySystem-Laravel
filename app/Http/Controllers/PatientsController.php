<?php

namespace App\Http\Controllers;

use App\DTO\PatientDTO;
use App\Http\Controllers\Controller;
use App\Services\PatientsServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function __construct(
        protected PatientsServices $patientsServices
    ){}

    public function store(Request $request)
    {
        try {
            $patient = $this->patientsServices->create(new PatientDTO($request));
        } catch (Exception $e) {
            return $e;
        }

        return response()->json([
            'pacientes' => $patient,
            'message' => 'Paciente cadastrado com sucesso!',
            'status' => 200
        ], 200);
    }

    public function index(Request $filter)
    {
        try {
            $patients = $this->patientsServices->index($filter);
        } catch (Exception $e) {
            return $e;
        }

        return response()->json([
            'pacientes' => $patients,
            'status' => 200
        ], 200);
    }

    public function show(string $id)
    {
        try {
            $patient = $this->patientsServices->findOne($id);
        } catch (Exception $e) {
            return $e;
        }

        return response()->json([
            'pacientes' => $patient,
            'status' => 200
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $patient = $this->patientsServices->delete($id);
        } catch (Exception $e) {
            throw new Exception($e);
        }

        return response()->json([
            'pacientes' => $patient,
            'status' => 200
        ], 200);
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $patient = $this->patientsServices->update(new PatientDTO($request));
        } catch (Exception $e) {
            throw new Exception("Não foi possível atualizar cadastro" . $e);
        }
        return response()->json([
            'pacientes' => $patient,
            'status' => 200
        ], 200);
    }
}
