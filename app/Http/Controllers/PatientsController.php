<?php

namespace App\Http\Controllers;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use App\Http\Controllers\Controller;
use App\Services\PatientsServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientsController extends Controller
{
    public function __construct(
        protected PatientsServices $patientsServices
    ){}

    public function store(Request $request)
    {
        try {
            $logged_user_id = Auth::id();
            $patient = $this->patientsServices->create(new CreatePatientDTO($request, $logged_user_id));
        } catch (Exception $e) {
            return $e;
        }

        return response()->json([
            'pacientes' => $patient,
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

    public function destroy(Request $id)
    {
        dd($id);

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
            $patient = $this->patientsServices->update(new UpdatePatientDTO($request));
        } catch (Exception $e) {
            throw new Exception("Não foi possível atualizar cadastro" . $e);
        }
        return response()->json([
            'pacientes' => $patient,
            'status' => 200
        ], 200);
    }
}
