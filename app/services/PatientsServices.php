<?php 

namespace App\Services;

use App\Models\Reason;
use stdClass;
use App\DTO\PatientDTO;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\DTO\Hospitalized\CreateHospitalizedDTO;
use App\Interfaces\PatientLogObserverInterface;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use App\Repositories\Hospitalized\HospitalizedRepositoryInterface;
use Carbon\Carbon;

class PatientsServices
{
    public function __construct(
        private PatientsRepositoryInterface $patientsRepository,
        private HospitalizedRepositoryInterface $hospitalizedRepository,
        private $observers = []
    ){
    }

    public function index()
    {
        return $this->patientsRepository->getAll();
    }
    public function create(Request $patientPayload)
    {
        $patientPayload->id = uuid_create();

        $patientDTO = new PatientDTO($patientPayload);

        $patient = $this->patientsRepository->create($patientDTO);
        
        if(!empty($patient) && $patientDTO->reason == 2){
            $this->createHospitalization(
                $patientPayload, 
                $patient->uuid
            );
        }

        return $patient;
    }

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
            $this->setLog($patientDTO->id, $patientDTO->reason);
        }


        return $this->patientsRepository->update($patientDTO);
    }

    public function findOne(string $id): Patient
    {
        return $this->patientsRepository->findOne($id);
    }

    public function delete(string $id)
    {
        return $this->patientsRepository->delete($id);
    }

    private function createHospitalization($patientPayload, int $patientId)
    {
        $patientDTO = new CreateHospitalizedDTO($patientPayload, $patientId);
        return $this->hospitalizedRepository->create($patientDTO);
    }

    public function findAllPatients($filterParam): mixed
    {
        $patients = $this->patientsRepository->findAllPatients($filterParam);
        
        foreach($patients as $patient){
            $patient['reason']     = $this->getReason($patient['reason']);
            $patient['created_at'] = $this->formatDate($patient['created_at']);
        }

        return $patients;
    }

    private function getReason($reasonId): string
    {
        $reason = new Reason();

        $reasonDescription = $reason->where('id',$reasonId)
            ->get('description')
            ->first()['description'];

        return $reasonDescription;
    }

    private function formatDate($date): string
    {
        $carbon = new Carbon($date);

        $createdAt = $carbon->format('d/m/Y');

        return $createdAt;
    }

    public function addObservers(PatientLogObserverInterface $observer): void {
        $this->observers[] = $observer;
    }

    public function setLog(string $patientId, string $patientStatus): void {
        foreach($this->observers as $observer) {
            $observer->setLog($patientId, $patientStatus);
        }
    }
}