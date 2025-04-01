<?php

namespace App\Http\Controllers;

use App\DTO\PatientDTO;
use App\Http\Controllers\Controller;
use App\Observers\PatientLogObserver;
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
            $patient = $this->patientsServices->create($request);
        } catch (Exception $e) {
            return response()->json([
                'message'   => 'Erro ao cadastrar paciente',
                'status'    => 'error'
            ], 500);
        }

        return response()->json([
            'pacientes' => $patient,
            'message' => 'Paciente cadastrado com sucesso!',
            'status' => 'success'
        ], 201);
    }

    public function index()
    {
        try {
            $patients = $this->patientsServices->index();
        } catch (Exception $e) {
            return response()->json([
                'Erro ao buscar pacientes'
            ], 500);
        }

        return response()->json([
            'pacientes' => $patients,
            'message' => 'Pacientes resgatados com sucesso!',
            'status' => 200
        ], 200);
    }

    public function show(string $id)
    {
        try {
            $patient = $this->patientsServices->findOne($id);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possível localizar paciente',
                'status' => 'error'
            ], 500);
        }

        return response()->json([
            'paciente' => $patient,
            'status' => 'success'
        ], 200);
    }

    public function destroy($id)
    {
        try {
            $this->patientsServices->delete($id);
        } catch (Exception $e) {
            return response()->json([
                'Erro ao deletar paciente'
            ], 500);
        }

        return response()->json([
            'message' => 'Paciente deletado com sucesso!',
            'status' => 200
        ], 200);
    }

    public function update(Request $request): JsonResponse
    {
        try {
            $this->patientsServices->addObservers(new PatientLogObserver());

            $this->patientsServices->update(new PatientDTO($request));
        } catch (Exception $e) {
            return response()->json([
                "Não foi possível atualizar cadastro" . $e->getMessage()
            ], 500);
        }
        return response()->json([
            'message' => 'Paciente atualizado com sucesso!',
            'status' => 200
        ], 200);
    }

    public function dashboard(?Request $filterBy): JsonResponse
    {
        try {
            $patients = $this->patientsServices->findAllPatients($filterBy);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Não foi possível resgatar pacientes'
            ], 500);
        }

        return response()->json([
            'message' => 'Pacientes resgatados com sucesso!',
            'pacientes' => $patients
        ], 200);
    }
}
