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
            return $e;
        }

        return response()->json([
            'pacientes' => $patient,
            'message' => 'Paciente cadastrado com sucesso!'
        ], 200);
    }

    public function index(Request $filter)
    {
        try {
            $patients = $this->hospitalizedServices->index($filter);
        } catch (Exception $e) {
            return 'Não foi possível recuperar os pacientes! ' . $e;
        }

        return response()->json([
            'pacientes' => $patients,
            'message' => 'Pacientes recuperados com sucesso!',
        ], 200);
    }

    public function show(string $id)
    {
        try {
            $patient = $this->hospitalizedServices->findOne($id);
        } catch (Exception $e) {
            return $e;
        }

        return response()->json([
            'pacientes' => $patient,
            'status' => 200
        ], 200);
    }

    public function delete(string $id)
    {
        try {
            $patient = $this->hospitalizedServices->delete($id);
        } catch (Exception $e) {
            throw new Exception($e);
        }

        return response()->json([
            'message' => 'Paciente deletado com sucesso!',
            'status' => 200
        ], 200);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $patient = $this->hospitalizedServices->update($request, $id);
        } catch (Exception $e) {
            throw new Exception("Não foi possível atualizar cadastro" . $e);
        }
        return response()->json([
            'pacientes' => $patient,
            'status' => 200
        ], 200);
    }
}
