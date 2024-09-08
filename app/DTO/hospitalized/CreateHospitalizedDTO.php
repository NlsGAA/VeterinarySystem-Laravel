<?php 

namespace App\DTO\Hospitalized;

use Illuminate\Http\Request;

class CreateHospitalizedDTO
{
    public ?string $id;
    public $user_id;
    public $patient_id;
    public int $situation_id;
    public int $doctor_id;
    public ?int $updated_by;

    public function __construct(Request $request, string $id = null)
    {
        $userId             = auth()->user()->id;
        $this->id           = $id;
        $this->user_id      = $userId;
        $this->patient_id   = $request->patient_id;
        $this->situation_id = $request->situacaoInternacao;
        $this->doctor_id    = $request->drResponsavel;
        $this->updated_by   = $userId;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function getPatientId()
    {
        return $this->patient_id;
    }

    public function getSituationId()
    {
        return $this->situation_id;
    }

    public function getDoctorId()
    {
        return $this->doctor_id;
    }
}