<?php

namespace App\Services\Game;

use App\Services\Player\Card;
use App\Services\Player\Hand;
use Exception;
use PHPUnit\Framework\TestCase;

class JudgeServiceTest extends TestCase
{
    public function testIsEvaluatingMatch(): void
    {
        $userHand = new Hand();
        $userHand->addCard(new Card(2));
        $userHand->addCard(new Card('A'));
        $userHand->addCard(new Card(10));

        $opponentHand = new Hand();
        $opponentHand->addCard(new Card('K'));
        $opponentHand->addCard(new Card(8));
        $opponentHand->addCard(new Card(3));

        $match = new Match($userHand, $opponentHand);

        $service = new JudgeService();
        $actual = $service->evaluateMatch($match);

        $this->assertInstanceOf(Match::class, $actual);
        $this->assertEquals(2, $actual->getUserScore());
        $this->assertEquals(1, $actual->getOpponentScore());
    }

    public function testIsThrowingExceptionFromScoreCheckOnEvaluatingMatch(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The scores from a match need to be zeroed so the match can be evaluated.');

        $userHand = new Hand();
        $userHand->addCard(new Card(2));
        $userHand->addCard(new Card('A'));
        $userHand->addCard(new Card(10));

        $opponentHand = new Hand();
        $opponentHand->addCard(new Card('K'));
        $opponentHand->addCard(new Card(8));
        $opponentHand->addCard(new Card(3));

        $match = new Match($userHand, $opponentHand);
        $match->addPointToOpponent();

        $service = new JudgeService();
        $actual = $service->evaluateMatch($match);
    }

    public function testIsThrowingExceptionFromHandSizeCheckOnEvaluatingMatch(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Both players need to have the same amount of cards in their hands.');

        $userHand = new Hand();
        $userHand->addCard(new Card(2));
        $userHand->addCard(new Card('A'));

        $opponentHand = new Hand();
        $opponentHand->addCard(new Card('K'));
        $opponentHand->addCard(new Card(8));
        $opponentHand->addCard(new Card(3));

        $match = new Match($userHand, $opponentHand);

        $service = new JudgeService();
        $actual = $service->evaluateMatch($match);
    }

    public function matchResultProvider(): array
    {
        return [
            [
                'userScore' => 3,
                'opponentScore' => 1,
                'expectedResult' => true
            ],
            [
                'userScore' => 1,
                'opponentScore' => 3,
                'expectedResult' => false
            ],
            [
                'userScore' => 2,
                'opponentScore' => 2,
                'expectedResult' => false
            ],
        ];
    }

    /**
     * @dataProvider matchResultProvider
     */
    public function testIsCheckingUserWon(int $userScore, int $opponentScore, bool $expectedResult): void
    {
        $service = new JudgeService();
        $actual = $service->checkUserWon($userScore, $opponentScore);

        $this->assertEquals($expectedResult, $actual);
    }
}
