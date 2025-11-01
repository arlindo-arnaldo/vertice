<?php

namespace App\Services;

use App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Support\Str;

class PostService
{
    private $repository;

    private $aiService;

    public function __construct(PostRepositoryInterface $repository, AiService $aiService)
    {
        $this->repository = $repository;
        $this->aiService = $aiService;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function create($data)
    {

        $data['slug'] = Str::slug($data['title']);

        $post = $this->repository->create($data);
        $this->aiService->summarize($post);

        return $post;
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

    public function simplifyText(string $text)
    {
        return $this->aiService->simplifyText($text);
    }
}
