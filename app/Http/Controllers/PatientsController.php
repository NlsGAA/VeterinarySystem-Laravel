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

    /**
     * @OA\Get(
     *     path="/patients",
     *     summary="Lista todos os pacientes",
     *     tags={"Pacientes"},
     *     @OA\Response(
     *         response=200,
     *         description="Pacientes recuperados com sucesso"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno no servidor"
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        try {
            $patients = $this->patientsServices->index();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Pacientes recuperados com sucesso!", $patients);
    }

    /**
     * @OA\Post(
     *     path="/patients",
     *     summary="Cadastra um novo paciente",
     *     tags={"Pacientes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string", example="João da Silva"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="birth_date", type="string", format="date", example="1990-01-01"),
     *             @OA\Property(property="tutor_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Paciente cadastrado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Dados inválidos"
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $patient = $this->patientsServices->create($request);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente cadastrado com sucesso!", $patient, 201);
    }

      /**
     * @OA\Get(
     *     path="/patients/{id}",
     *     summary="Recupera os dados de um paciente",
     *     tags={"Pacientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do paciente",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente recuperado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente não encontrado"
     *     )
     * )
     */
    public function show(string $id): JsonResponse
    {
        try {
            $patient = $this->patientsServices->findOne($id);
            $patientResource = new PatientResource($patient)->toArray(request());
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente recuperado com sucesso!", $patientResource);
    }

     /**
     * @OA\Delete(
     *     path="/patients/{id}",
     *     summary="Remove um paciente",
     *     tags={"Pacientes"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do paciente",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente deletado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Paciente não encontrado"
     *     )
     * )
     */
    public function destroy($id): JsonResponse
    {
        try {
            $this->patientsServices->delete($id);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage());
        }

        return $this->sendResponse("Paciente deletado com sucesso!", null);
    }

    /**
     * @OA\Put(
     *     path="/patients",
     *     summary="Atualiza os dados de um paciente",
     *     tags={"Pacientes"},
    *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do paciente",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="João da Silva Atualizado"),
     *             @OA\Property(property="email", type="string", example="joao@email.com"),
     *             @OA\Property(property="birth_date", type="string", format="date", example="1990-01-01")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Paciente atualizado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro na requisição"
     *     )
     * )
     */
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


    /**
     * @OA\Get(
     *     path="/patients/dashboard",
     *     summary="Retorna pacientes para o dashboard, com filtros opcionais",
     *     tags={"Pacientes"},
     *     @OA\Parameter(
     *         name="filter",
     *         in="query",
     *         description="Filtro de busca",
     *         required=false,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Pacientes recuperados com sucesso"
     *     )
     * )
     */
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
