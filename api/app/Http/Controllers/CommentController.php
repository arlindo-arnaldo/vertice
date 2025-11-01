<?php

namespace App\Http\Controllers;

use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $service)
    {
        $this->commentService = $service;
    }

    public function index()
    {
        try {
            $data = $this->commentService->getAll();

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }

    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'content' => 'required',
                'post_id' => 'required|exists:posts,id',
                'parent_id' => 'nullable|exists:comments,id',
            ]);
            $category = $this->commentService->create($data);

            return response()->json($category);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function show(int $id)
    {
        try {
            $category = $this->commentService->findById($id);
            if (! $category) {
                return response()->json('nao encontrado', 404);
            }

            return response()->json($category);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function update(int $id, Request $request)
    {
        try {
            $data = $request->validate([
                'content' => 'required',
            ]);

            $category = $this->commentService->update($id, $data);

            return response()->json($category);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            return $this->commentService->delete($id);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
