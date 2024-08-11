<?php

namespace App\Http\Controllers;

use App\DTO\Hospitalized\CreateHospitalizedDTO;
use App\Http\Controllers\Controller;
use App\Services\HospitalizedServices;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalizedController extends Controller
{
    public function __construct(
        protected HospitalizedServices $hospitalizedServices
    ){}

    public function store(Request $request)
    {
        try {
            $logged_user_id = Auth::id();
            $patient = $this->hospitalizedServices->create(new CreateHospitalizedDTO($request, $logged_user_id));
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
            $patients = $this->hospitalizedServices->index($filter);
        } catch (Exception $e) {
            return $e;
        }

        return response()->json([
            'pacientes' => $patients,
            'message' => 'Pacientes recuperados com sucesso!',
            'status' => 200
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

    public function destroy(Request $id)
    {
        try {
            $patient = $this->hospitalizedServices->delete($id);
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
            $logged_user_id = Auth::id();
            $patient = $this->hospitalizedServices->update(new CreateHospitalizedDTO($request, $logged_user_id));
        } catch (Exception $e) {
            throw new Exception("Não foi possível atualizar cadastro" . $e);
        }
        return response()->json([
            'pacientes' => $patient,
            'status' => 200
        ], 200);
    }
}
