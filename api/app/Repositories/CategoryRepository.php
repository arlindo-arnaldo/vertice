<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    private $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function getAll(): Collection
    {
        return $this->model->orderBy('title')->get();
    }

    public function getParentCategories(): Collection
    {
        return $this->model->whereNull('parent_id')->with(['children'])->orderBy('nome')->get();
    }

    public function find(int $id): ?Category
    {
        return $this->model->with(['parent', 'children'])->find($id);
    }

    public function create(array $data): Category
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Category|bool
    {
        $category = $this->model->find($id);
        if (! $category) {
            return false;
        }
        $category->update($data);

        return $category;
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id) > 0;
    }
}
