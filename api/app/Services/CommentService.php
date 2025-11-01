<?php

namespace App\Services;

use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentService
{
    private $repository;

    public function __construct(CommentRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getParentComments();
    }

    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function findById($id)
    {
        return $this->repository->find($id);
    }

    public function update($id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}
