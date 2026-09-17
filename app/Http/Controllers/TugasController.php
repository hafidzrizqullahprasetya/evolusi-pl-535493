<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\JsonResponse;

class TugasController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Tugas::query()->orderBy('tenggat')->get(),
        ]);
    }

    public function show(Tugas $tugas): JsonResponse
    {
        return response()->json([
            'data' => $tugas,
        ]);
    }
}
