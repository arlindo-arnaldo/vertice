<?php

namespace App\Http\Controllers;

use App\Services\ClapService;
use Illuminate\Http\Request;

class ClapController extends Controller
{
    protected $clapService;

    public function __construct(ClapService $service)
    {
        $this->clapService = $service;
    }

    public function store(Request $request, $post_id)
    {
        try {
            $total = $this->clapService->addClap($post_id, auth('sanctum')->id(), $request->input('count', 1));

            return response()->json(['total' => $total]);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage());
        }
    }
}
