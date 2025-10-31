<?php

namespace App\Services;

use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Str;

class PostService
{
    private $repository;

    public function __construct(PostRepositoryInterface $repository)
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

    public function findBySlug($slug)
    {
        return $this->repository->findBySlug($slug);
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

    public function getFeaturedPosts()
    {
        return $this->repository->featuredPosts();
    }

    public function getPublishedPosts()
    {
        return $this->repository->publishedPosts();
    }

    public function getUnpublishedPosts()
    {
        return $this->repository->unpublishedPosts();
    }

    public function uploadFile($file)
    {
        return $file->store();
    }
}
