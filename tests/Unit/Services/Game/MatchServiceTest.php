<?php

namespace App\Services\Game;

use App\Repositories\ResultRepository;
use App\Services\Player\Card;
use App\Services\Player\Hand;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Mockery;
use PHPUnit\Framework\TestCase;

class MatchServiceTest extends TestCase
{
    public function testIsCreatingMatch(): void
    {
        $userHand = new Hand();
        $userHand->addCard(new Card(2));
        $userHand->addCard(new Card('A'));
        $userHand->addCard(new Card(10));

        $opponentHand = new Hand();
        $opponentHand->addCard(new Card('K'));
        $opponentHand->addCard(new Card(8));
        $opponentHand->addCard(new Card(3));

        $resultRepositoryMock = Mockery::mock(ResultRepository::class);

        $service = new MatchService($resultRepositoryMock);
        $actual = $service->create($userHand, $opponentHand);

        $this->assertInstanceOf(Match::class, $actual);
        $this->assertEquals($userHand, $actual->getUserHand());
        $this->assertEquals($opponentHand, $actual->getOpponentHand());
    }

    public function testIsThrowingExceptionOnCreatingMatch(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('A match cannot be created with an empty hand.');

        $userHand = new Hand();
        $opponentHand = new Hand();

        $resultRepositoryMock = Mockery::mock(ResultRepository::class);

        $service = new MatchService($resultRepositoryMock);
        $actual = $service->create($userHand, $opponentHand);
    }

    public function testIsSavingMatch(): void
    {
        $input = [
            'name' => 'Foo',
            'user_score' => 3,
            'opponent_score' => 1,
            'user_win' => true,
        ];

        $resultRepositoryMock = Mockery::mock(ResultRepository::class);
        $resultRepositoryMock->shouldReceive('save')->once()->with($input);

        $service = new MatchService($resultRepositoryMock);
        $actual = $service->save($input);

        $this->assertNull($actual);
    }

    public function testIsGettingLeadboard(): void
    {
        $dataFromDatabase = new Collection([
            [
                'name' => 'Foo',
                'total_matches' => 9,
                'total_wins' => 3,
            ],
        ]);

        $resultRepositoryMock = Mockery::mock(ResultRepository::class);
        $resultRepositoryMock->shouldReceive('leadboard')
            ->once()
            ->with()
            ->andReturn($dataFromDatabase);

        $service = new MatchService($resultRepositoryMock);
        $actual = $service->leadboard($dataFromDatabase);

        $this->assertIsArray($actual);
        $this->assertEquals(1, count($actual));
        $this->assertArrayHasKey('name', $actual[0]);
        $this->assertArrayHasKey('total_matches', $actual[0]);
        $this->assertArrayHasKey('total_wins', $actual[0]);
        $this->assertIsString($actual[0]['name']);
        $this->assertIsInt($actual[0]['total_matches']);
        $this->assertIsInt($actual[0]['total_wins']);
    }

    public function testIsGettingLeadboardEmpty(): void
    {
        $dataFromDatabase = new Collection();

        $resultRepositoryMock = Mockery::mock(ResultRepository::class);
        $resultRepositoryMock->shouldReceive('leadboard')
            ->once()
            ->with()
            ->andReturn($dataFromDatabase);

        $service = new MatchService($resultRepositoryMock);
        $actual = $service->leadboard($dataFromDatabase);

        $this->assertIsArray($actual);
        $this->assertEquals(0, count($actual));
    }
}
