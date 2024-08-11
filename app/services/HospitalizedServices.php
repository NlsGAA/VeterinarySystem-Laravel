<?php 

namespace App\Services;

use App\Models\Patient;
use App\Repositories\Hospitalized\HospitalizedRepository;
use Illuminate\Http\Request;
use App\DTO\Hospitalized\CreateHospitalizedDTO;
use Carbon\Carbon;
use stdClass;

class HospitalizedServices
{
    public function __construct(
        private HospitalizedRepository $hospitalizedRepository
    ){
    }

    public function index(Request $filter)
    {
        $data = [];
        $patients_hospitalized = $this->hospitalizedRepository->getAll($filter);

        foreach($patients_hospitalized as $key_data => $value_data){
            $data[$key_data]['days_hospitalized'] = $this->diffForHumans($value_data['created_at']);
            $data[$key_data]['entry_date'] = $this->dateFormat($value_data['created_at']);
            $data[$key_data]['patient_data'] = $value_data;
        }

        return $data;
    }

    private function dateFormat($date)
    {
        Carbon::setLocale('pt-BR');
        $date = Carbon::createFromDate($date);
        return $date->format('d/m/Y H:i:s');
    }

    private function diffForHumans($date)
    {
        Carbon::setLocale('pt-BR');
        $date = Carbon::createFromDate($date);
        return $date->diffForHumans();
    }

    public function create(CreateHospitalizedDTO $createHospitalizedDTO)
    {
        $patient = $this->hospitalizedRepository->create($createHospitalizedDTO);
        

        return $patient;
    }

    public function update(CreateHospitalizedDTO $createHospitalizedDTO): stdClass|null
    {
        return $this->hospitalizedRepository->update($createHospitalizedDTO);
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