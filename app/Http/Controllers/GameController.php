<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayGameRequest;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function leadboard(): JsonResponse
    {
        return new JsonResponse();
    }

    public function play(PlayGameRequest $request): JsonResponse
    {
        return new JsonResponse();
    }
}
