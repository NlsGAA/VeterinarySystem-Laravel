<?php 

namespace App\Repositories\Hospitalized;

use App\Repositories\Contracts\BaseRepository;
use App\Models\HospitalizedPatients;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HospitalizedRepository extends BaseRepository implements HospitalizedRepositoryInterface
{
    public function __construct(
        private HospitalizedPatients $hospitalizedPatients
    ){
        parent::__construct($this->hospitalizedPatients);
    }

    public function getAll(): array|Collection
    {
        $patients = $this->hospitalizedPatients
            ->join('patients', 'hospitalization.patient_id', 'patients.id')
            ->join('users', 'hospitalization.doctor_id', 'users.id')
            ->join('hospitalized_situation', 'hospitalization.situation_id', 'hospitalized_situation.situation_id')
            ->select('hospitalization.created_at', 'patients.*',
                'hospitalized_situation.name as name_situation',
                'users.name as doctor_name')
            ->orderBy('hospitalization.created_at', 'asc')
            ->get();

        return $patients;
    }

    public function findByPatientId($patientId){
        $patient = DB::table('hospitalization')
            ->where('patient_id', $patientId)
            ->whereNull('deleted_at')
            ->first();
            
        return $patient;
    }
}