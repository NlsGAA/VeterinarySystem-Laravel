<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use stdClass;

interface BaseRepositoryInterface
{
    public function getAll(): array|Collection;

    public function findOne(string $id): Model;

    public function findBy(string $coloumn, string $operator = '=', string $value): Model|null;

    public function create($modelDto): Model;

    public function update($modelDto): stdClass|null|bool;

    public function delete(string $id): void;
}