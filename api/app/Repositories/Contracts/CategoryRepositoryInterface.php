<?php

namespace App\Repositories\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryRepositoryInterface
{
    //Obtem todas as categorias
    public function getAll(): Collection;

    //Obtem as categorias do nivel superior

    public function getParentCategories(): Collection;

    public function find(int $id): ?Category;

    public function create(array $data): Category;

    public function update(int $id, array $data): Category|bool;

    public function delete(int $id): bool;
}
