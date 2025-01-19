<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class PatientsRepository extends BaseRepository implements PatientsRepositoryInterface
{
    public function __construct(
        private readonly Patient $patient,
    ){
        parent::__construct($this->patient);
    }

    public function findAllPatients($filterParam)
    {
        $sql = $this->patient
            ->join('owners_data', 'patients.owner_id', '=', 'owners_data.id')
            ->select(
                DB::raw("CONCAT(owners_data.firstName, ' ', owners_data.lastName) AS owner_name"),
                'patients.*',
            )
            ->where(function(Builder $q) use ($filterParam) {
                if(!empty($filterParam->filter)) {
                    return $q->whereLike('patients.name', "%{$filterParam->filter}%")
                    ->orWhere('patients.id', $filterParam)
                    ->orWhereLike('patients.species', $filterParam);
                }
            })
            ->orderBy('patients.created_at', 'asc')
            ->get();

        return $sql;
    }
}