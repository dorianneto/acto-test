<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function leadboard(): JsonResponse
    {
        return new JsonResponse();
    }

    public function new(Request $request): JsonResponse
    {
        return new JsonResponse();
    }

    public function play(Request $request): JsonResponse
    {
        return new JsonResponse();
    }
}
