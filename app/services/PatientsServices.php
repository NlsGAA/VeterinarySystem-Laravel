<?php

namespace App\Services;

use App\Models\Reason;
use stdClass;
use App\DTO\PatientDTO;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\DTO\Hospitalized\CreateHospitalizedDTO;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use App\Repositories\Hospitalized\HospitalizedRepositoryInterface;
use Carbon\Carbon;

class PatientsServices extends BaseService
{
    public function __construct(
        private PatientsRepositoryInterface $patientsRepository,
        private HospitalizedRepositoryInterface $hospitalizedRepository,
    ){
    }

    /**
     * Display a list of all patients
     *
     * @return array
     */
    public function index()
    {
        return $this->patientsRepository->getAll()->toArray();
    }

    /**
     * Create a new patient
     *
     * @param Request $patientPayload
     * @return array
     */
    public function create(Request $patientPayload): array
    {
        $patientDTO = new PatientDTO($patientPayload);
        $patient    = $this->patientsRepository->create($patientDTO);

        if(!empty($patient) && $patientDTO->reason == 2){
            $this->createHospitalization(
                $patientPayload,
                $patient->uuid
            );
        }

        return $patient->toArray();
    }

    /**
     * Update a patient
     * TODO: refactor this
     *
     * @param PatientDTO $patientDTO
     * @return bool
     */
    public function update(PatientDTO $patientDTO): stdClass|null|bool
    {
        $patient             = $this->patientsRepository->findBy('id', 'like', $patientDTO->id);
        $patientHospitalized = $this->hospitalizedRepository->findByPatientId($patientDTO->id);

        if($patientDTO->reason == 2 && !$patientHospitalized){
            $this->hospitalizedRepository->create($patientDTO);
        }
        if($patientDTO->reason != 2 && $patientHospitalized){
            $this->hospitalizedRepository->delete($patientDTO->id);
        }
        if($patientDTO->reason != $patient->reason){
            $this->notifyObservers($patientDTO->id, $patientDTO->reason);
        }

        return $this->patientsRepository->update($patientDTO);
    }

    /**
     * Find a patient by id
     *
     * @param string $id
     * @return Patient
     */
    public function findOne(string $id): Patient
    {
        return $this->patientsRepository->findOne($id);
    }

    /**
     * Delete a patient
     *
     * @param string $id
     * @return bool
     */
    public function delete(string $id): bool
    {
        return $this->patientsRepository->delete($id);
    }

    /**
     * Create a hospitalized patient record
     *
     * @param Request $patientPayload
     * @param int $patientId
     */
    private function createHospitalization($patientPayload, int $patientId)
    {
        $patientDTO = new CreateHospitalizedDTO($patientPayload, $patientId);
        return $this->hospitalizedRepository->create($patientDTO);
    }

    /**
     * Find all patients with filters
     * TODO: moving this to index method and create a resource to format
     *
     * @param $filterParam
     * @return array
     */
    public function findAllPatients($filterParam): ?array
    {
        $patients = $this->patientsRepository->findAllPatients($filterParam);

        foreach($patients as $patient){
            $patient['reason']     = $this->getReason($patient['reason']);
            $patient['created_at'] = $this->formatDate($patient['created_at']);
        }

        return $patients->toArray();
    }

    /**
     * Get reason description
     *
     * @param $reasonId
     * @return string
     */
    private function getReason($reasonId): string
    {
        $reason = new Reason();

        $reasonDescription = $reason->where('id',$reasonId)
            ->get('description')
            ->first()['description'];

        return $reasonDescription;
    }

    /**
     * Format date
     * TODO: remove this from patient service
     *
     * @param $date
     * @return string
     */
    private function formatDate($date): string
    {
        $carbon = new Carbon($date);

        $createdAt = $carbon->format('d/m/Y');

        return $createdAt;
    }
}