<?php 

namespace App\Services;

use App\DTO\Hospitalized\CreateHospitalizedDTO;
use Illuminate\Http\Request;
use App\Repositories\Hospitalized\HospitalizedRepositoryInterface;
use Carbon\Carbon;
use stdClass;

class HospitalizedServices
{
    public function __construct(
        private HospitalizedRepositoryInterface $hospitalizedRepository,
        private Carbon $carbon
    ){
        $this->carbon->setLocale('pt-BR');
    }

    public function findOne(string $id)
    {
        return $this->hospitalizedRepository->findOne($id);
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

    public function create(CreateHospitalizedDTO $hospitalizedDTO)
    {
        return $this->hospitalizedRepository->create($hospitalizedDTO);
    }

    public function update(Request $hospitalizedPayload, string $id): stdClass|null|bool
    {
        $hospitalized = $this->hospitalizedRepository->findBy('patient_id', $id);
        $hospitalizedDTO = new CreateHospitalizedDTO($hospitalizedPayload, $hospitalized->id);

        return $this->hospitalizedRepository->update($hospitalizedDTO);
    }

    public function delete(string $id)
    {
        $hospitalized = $this->hospitalizedRepository->findBy('patient_id', $id);
        $this->hospitalizedRepository->delete($hospitalized->id);
    }
}