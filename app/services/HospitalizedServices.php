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

    /**
     * Find a hospitalized patient by id
     *
     * @param string $id
     */
    public function findOne(string $id)
    {
        return $this->hospitalizedRepository->findOne($id);
    }

    /**
     * Display a list of all hospitalized patients
     *
     * @param Request $filter
     * @return array
     */
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

    /**
     * Create a new hospitalized patient
     *
     * @param CreateHospitalizedDTO $hospitalizedDTO
     * @return array
     */
    public function create(CreateHospitalizedDTO $hospitalizedDTO)
    {
        return $this->hospitalizedRepository->create($hospitalizedDTO);
    }

    /**
     * Update a hospitalized patient
     *
     * @param Request $hospitalizedPayload
     * @param string $id
     */
    public function update(Request $hospitalizedPayload, string $id): stdClass|null|bool
    {
        $hospitalized = $this->hospitalizedRepository->findBy('patient_id', $id);
        $hospitalizedDTO = new CreateHospitalizedDTO($hospitalizedPayload, $hospitalized->id);

        return $this->hospitalizedRepository->update($hospitalizedDTO);
    }

    /**
     * Delete a hospitalized patient
     *
     * @param string $id
     * @return void
     */
    public function delete(string $id): void
    {
        $hospitalized = $this->hospitalizedRepository->findBy('patient_id', $id);
        $this->hospitalizedRepository->delete($hospitalized->id);
    }
}