<?php

namespace App\Repositories\Contracts;

use App\DTO\CreatePatientDTO;
use App\DTO\UpdatePatientDTO;
use stdClass;

interface BaseRepository
{

    public function getAll(string $filter = null): array;

    public function findOne(string $id): stdClass|null;

    public function create(CreatePatientDTO $createPatientDTO): stdClass;

    public function update(UpdatePatientDTO $updatePatientDTO): stdClass|null;

    public function delete(string $id): void;
}