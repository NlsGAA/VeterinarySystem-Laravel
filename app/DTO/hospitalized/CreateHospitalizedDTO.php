<?php 

namespace App\DTO\Hospitalized;

use Illuminate\Http\Request;

class CreateHospitalizedDTO
{
    public $user_id;
    public $patient_id;
    public int $SituationId;
    public int $DoctorId;

    public function __construct(Request $request, $logged_user_id)
    {
        $this->user_id              = $logged_user_id;  
        $this->patient_id           = $request->patient_id;
        $this->SituationId          = $request->situacaoInternacao;
        $this->DoctorId             = $request->drResponsavel;
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
        return $this->SituationId;
    }

    public function getDoctorId()
    {
        return $this->DoctorId;
    }
}