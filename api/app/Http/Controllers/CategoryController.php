<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $service)
    {
        $this->categoryService = $service;
    }

    public function index()
    {
        try {
            $data = $this->categoryService->getAll();

            return response()->json($data);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }

    }

    public function store(CategoryRequest $request)
    {
        try {
            $data = $request->validated();
            $category = $this->categoryService->create($data);

            return response()->json($category);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function show(int $id)
    {
        try {
            $category = $this->categoryService->findById($id);
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
                'title' => 'unique:categories,title,'.$id,
                'parent_id' => 'nullable|exists:categories,id',
            ]);

            $category = $this->categoryService->update($id, $data);

            return response()->json($category);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            return $this->categoryService->delete($id);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
