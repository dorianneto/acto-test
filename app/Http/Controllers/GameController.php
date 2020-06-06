<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayGameRequest;
use App\Services\Player\HandService;
use App\Services\Game\JudgeService;
use App\Services\Game\MatchService;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    /**
     * @var \App\Services\Player\HandService
     */
    private $handService;

    /**
     * @var \App\Services\Game\JudgeService
     */
    private $judgeService;

    /**
     * @var \App\Services\Game\MatchService
     */
    private $matchService;

    public function __construct(HandService $handService, JudgeService $judgeService, MatchService $matchService)
    {
        $this->handService = $handService;
        $this->judgeService = $judgeService;
        $this->matchService = $matchService;
    }

    public function leadboard(): JsonResponse
    {
        return new JsonResponse();
    }

    public function play(PlayGameRequest $request): JsonResponse
    {
        ['name' => $userName, 'hand' => $userHand] = $request->all();

        $userHand = $this->handService->build($userHand);
        $opponentHand = $this->handService->generate($userHand->count());

        $scores = $this->judgeService->evaluate($userHand, $opponentHand);

        $result = [
            'name' => $userName,
            'scores' => $scores,
            'userWin' => $this->judgeService->checkUserWon($scores),
        ];

        $this->matchService->save([
            'name' => $result['name'],
            'user_score' => $result['scores']['user'],
            'opponent_score' => $result['scores']['opponent'],
            'user_win' => $result['userWin'],
        ]);

        return new JsonResponse($result);
    }
}
