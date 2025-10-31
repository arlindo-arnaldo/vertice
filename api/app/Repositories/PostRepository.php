<?php

namespace App\Repositories;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class PostRepository implements PostRepositoryInterface
{
    private $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function getAll(): Collection
    {
        return $this->model->orderBy('title')->get();
    }

    public function find(int $id): ?Post
    {
        return $this->model->with(['categories'])->find($id);
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->model->with(['categories'])->where('slug', $slug)->first();
    }

    public function create(array $data): Post
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Post|bool
    {
        $post = $this->model->find($id);
        if (! $post) {
            return false;
        }
        $post->update($data);

        return $post;
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id) > 0;
    }

    public function featuredPosts(): Collection
    {
        return $this->model->where('is_featured', true)->get();
    }

    public function publishedPosts(): Collection
    {
        return $this->model->where('is_published', true)->get();
    }

    public function unpublishedPosts(): Collection
    {
        return $this->model->where('is_published', false)->get();
    }
}
