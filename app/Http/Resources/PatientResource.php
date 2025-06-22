<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name'      => $this->name,
            'species'   => $this->species,
            'breed'     => $this->breed,
            'id'        => $this->cutPatientId($this->id),
            'weight'    => $this->getWeightType(
                $this->weight,
                $this->weight_type
            ),
            'age'       => $this->formatAge(
                $this->age,
                $this->age_type
            ),
            'owner'     => [
                'name'      => $this->owner->firstName . ' ' . $this->owner->lastName,
                'cellphone' => $this->owner->cellphone,
                'email'     => $this->owner->email,
                'address'   => $this->owner->address,
            ],
        ];
    }

    private function cutPatientId(string $id): string
    {
        $idExploded = explode('-', $id);
        return $idExploded[0];
    }

    private function getWeightType(string $weight, string $weightType): string
    {
        $kgOrGrams = ($weightType == 0) ? 'Kg' : 'Gramas';
        return $weight . ' ' . $kgOrGrams;
    }

    private function formatAge(string $age, string $ageType): string
    {
        $yearsOrMonths = ($ageType == 0) ? 'Anos' : 'Meses';
        return $age . ' ' . $yearsOrMonths;
    }
}
