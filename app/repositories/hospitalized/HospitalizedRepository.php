<?php 

namespace App\Repositories\Hospitalized;

use App\DTO\Hospitalized\CreateHospitalizedDTO;
use App\DTO\PatientDTO;
use Illuminate\Database\Eloquent\Model;
use App\Models\HospitalizedPatients;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class HospitalizedRepository implements HospitalizedRepositoryInterface
{
    public function __construct(private HospitalizedPatients $hospitalizedPatients){
    }

    public function getAll(Request $filter = null)
    {
        $patients = $this->hospitalizedPatients
                    ->join('patients', 'hospitalization.patient_id', 'patients.patient_id')
                    ->join('users', 'hospitalization.doctor_id', 'users.id')
                    ->join('hospitalized_situation', 'hospitalization.situation_id', 'hospitalized_situation.situation_id')
                    ->select('hospitalization.created_at', 'patients.*',
                        'hospitalized_situation.name as name_situation',
                        'users.name as doctor_name')
                    ->orderBy('hospitalization.created_at', 'asc')
                    ->get();

        return $patients;
    }

    public function findOne(string $id): Model
    {
        return $this->hospitalizedPatients->findOrFail($id);
    }

    public function findByPatientId(string $id){
        $patient = DB::table('hospitalization')
                    ->where('patient_id', $id)
                    ->whereNull('deleted_at')
                    ->first();
        return $patient;
    }

    public function create(PatientDTO $patientHospitalizedDTO, $patient_id = null): stdClass
    {
        $hospitalizedPatient = $this->hospitalizedPatients->create([
            'patient_id'    => $patientHospitalizedDTO->patient_id ?? $patient_id,
            'doctor_id'     => $patientHospitalizedDTO->doctorId,
            'situation_id'  => $patientHospitalizedDTO->situationId,
            'updated_by'    => $patientHospitalizedDTO->user_id
        ]);

        return (object) $hospitalizedPatient->toArray();
    }

    public function update(CreateHospitalizedDTO $createHospitalizedDTO): stdClass|null
    {

        $patient = $this->hospitalizedPatients->find($createHospitalizedDTO->patient_id);

        if(!$patient) return null;

        $patient->update(
            (array) $createHospitalizedDTO
        );

        return (object) $patient->toArray();
    }

    public function delete(string $id): void
    {
        $this->hospitalizedPatients->find($id)->delete();
    }
}