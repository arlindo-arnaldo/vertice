<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentRepositoryInterface
{
    // Obtem todas as categorias
    public function getAll(): Collection;
    public function getParentComments(): Collection;

    public function find(int $id): ?Comment;

    public function create(array $data): Comment;

    public function update(int $id, array $data): Comment|bool;

    public function delete(int $id): bool;
}
