<?php

namespace App\Repositories;

use App\Models\Patient;
use App\Models\Reason;
use App\Repositories\Contracts\BaseRepository;
use App\Repositories\Contracts\PatientsRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PatientsRepository extends BaseRepository implements PatientsRepositoryInterface
{
    public function __construct(
        private readonly Patient $patient,
    ){
        parent::__construct($this->patient);
    }

    public function findOne(string $id): Model
    {
        $patient = $this->patient->findOrFail($id)->with('owner')->first();

        $reasons = Reason::where('id', $patient->reason)->first();

        $patient->reason = $reasons->description;

        return $patient;
    }

    public function findAllPatients($filterParam)
    {
        $sql = $this->patient
            ->join('owners_data', 'patients.owner_id', '=', 'owners_data.id')
            ->select(
                DB::raw("CONCAT(owners_data.\"firstName\", ' ', owners_data.\"lastName\") AS owner_name"),
                'patients.*',
            )
            ->where(function(Builder $q) use ($filterParam) {
                if(!empty($filterParam->filter)) {
                    return $q->whereLike('patients.name', "%{$filterParam->filter}%")
                    ->orWhereLike('patients.species', $filterParam->filter);
                }
            })
            ->orderBy('patients.created_at', 'asc')
            ->get();
        
        return $sql;
    }
}