<?php 

namespace App\Services;

use App\Models\Patient;
use App\Repositories\Hospitalized\HospitalizedRepository;
use Illuminate\Http\Request;
use App\DTO\PatientDTO;
use Carbon\Carbon;
use stdClass;

class HospitalizedServices
{
    public function __construct(
        private HospitalizedRepository $hospitalizedRepository,
        private Carbon $carbon
    ){
        $this->carbon->setLocale('pt-BR');
    }

    public function index(Request $filter)
    {
        $data = [];
        $patients_hospitalized = $this->hospitalizedRepository->getAll($filter);

        foreach($patients_hospitalized as $data_key => $patient_data){
            $date = $this->carbon->createFromDate($patient_data['created_at']);
            $data[$data_key]['days_hospitalized'] = $date->diffForHumans();
            $data[$data_key]['entry_date'] = $date->format('d/m/Y H:i:s');
            $data[$data_key]['patient_data'] = $patient_data;
        }

        return $data;
    }

    public function create(PatientDTO $patientDTO)
    {
        $patient = $this->hospitalizedRepository->create($patientDTO);
        
        return $patient;
    }

    public function update(PatientDTO $patientDTO): stdClass|null
    {
        return $this->hospitalizedRepository->update($patientDTO);
    }

    public function findOne(string $id): Patient
    {
        return $this->hospitalizedRepository->findOne($id);
    }

    public function delete(string $id)
    {
        $this->hospitalizedRepository->delete($id);
    }
}