<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private $postService;

    public function __construct(PostService $service)
    {
        $this->postService = $service;
    }

    public function index()
    {
        try {
            return response()->json($this->postService->getAll());
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function store(PostRequest $request)
    {
        try {

            return response()->json($this->postService->create($request->validated()));
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function show($idOrSlug)
    {
        try {
            if (is_numeric($idOrSlug)) {
                $id = (int) $idOrSlug;
                $post = $this->postService->findById($id);
            } else {
                $slug = $idOrSlug;
                $post = $this->postService->findBySlug($slug);
            }

            return response()->json($post);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function update(int $id, Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required|unique:posts,title,'.$id,
                'content' => 'required'
            ]);

            $post = $this->postService->update($id, $data);

            return response()->json($post);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            return $this->postService->delete($id);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
