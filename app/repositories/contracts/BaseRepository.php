<?php

namespace App\Repositories\Contracts;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

interface BaseRepository
{
    public function getAll(Request $filter = null);

    public function findOne(string $id): Model;

    public function create(CreatePatientDTO $createPatientDTO): stdClass;

    public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null;

    public function delete(string $id): void;
}