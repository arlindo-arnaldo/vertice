<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService
{
    private $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create($data)
    {
        $data['slug'] = Str::slug($data['title']);

        return $this->repository->create($data);
    }

    public function findById($id)
    {
        return $this->repository->find($id);
    }

    public function update($id, $data)
    {
        $data['slug'] = Str::slug($data['title']);
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
