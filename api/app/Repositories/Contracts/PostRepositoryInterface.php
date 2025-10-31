<?php

namespace App\Repositories\Contracts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

interface PostRepositoryInterface
{
    public function getAll(): Collection;

    public function find(int $id): ?Post;
    public function findBySlug(string $slug): ?Post;

    public function create(array $data): Post;

    public function update(int $id, array $data): Post|bool;

    public function delete(int $id): bool;

    public function featuredPosts(): Collection;

    public function publishedPosts(): Collection;
    public function unpublishedPosts(): Collection;
}
