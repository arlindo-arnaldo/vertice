<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository implements CommentRepositoryInterface
{
    private $model;

    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

    public function getAll(): Collection
    {
        return $this->model->orderByDesc('created_at')->get();
    }
    public function getParentComments(): Collection
    {
        return $this->model->whereNull('parent_id')->with('answers')->get();
    }

    public function find(int $id): ?Comment
    {
        return $this->model->with(['answers', 'parent'])->find($id);
    }

    public function create(array $data): Comment
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data): Comment|bool
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
}
