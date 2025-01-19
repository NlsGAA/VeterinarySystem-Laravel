<?php 

namespace App\DTO;

use Illuminate\Http\Request;

class PatientDTO
{
    public $user_id;
    public ?string $id = null;
    public string $name;
    public string $breed;
    public string $species;
    public string $weight;
    public int $weight_type;
    public string $color;
    public int $age;
    public int $age_type;
    public string $origin;
    public string $reason;
    public ?string $image;
    public int $situationId;
    public int $doctorId;
    public int $owner_id;

    public function __construct(Request $request, $patientId = null)
    {
        $this->user_id      = auth()->user()->id;
        $this->id           = $request->id ?? $patientId;
        $this->name         = $request->name;
        $this->breed        = $request->breed;
        $this->species      = $request->species;
        $this->weight       = $request->weight;
        $this->color        = $request->color;
        $this->age          = $request->age;
        $this->origin       = $request->origin;
        $this->reason       = $request->reason;
        $this->weight_type  = (int) $request->weight_type;
        $this->age_type     = (int) $request->age_type;
        $this->owner_id     = (int) $request->owner;

        if ($request->hasFile("images")) {
            $imagePath = [];
            foreach ($request->file("images") as $image) {
                $path = $image->store("images/pacientes/$this->name");
                $imagePath[] = $path;
            }
            $this->image = json_encode($imagePath);
        }
    }
}