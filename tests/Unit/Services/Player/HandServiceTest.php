<?php

namespace App\Services\Player;

use PHPUnit\Framework\TestCase;

class HandServiceTest extends TestCase
{
    public function testIsBuildingValidHand(): void
    {
        $hand = ['A', 2, 4, 10, 'K'];

        $service = new HandService();

        $actual = $service->build($hand);

        $this->assertInstanceOf(Hand::class, $actual);
        $this->assertEquals(count($hand), $actual->count());
        $this->assertEquals($hand, $actual->toArray());
    }

    public function testIsGeneratingHand(): void
    {
        $handSizeExpected = 4;

        $service = new HandService();

        $actual = $service->generate($handSizeExpected);

        $this->assertInstanceOf(Hand::class, $actual);
        $this->assertEquals($handSizeExpected, $actual->count());
    }
}
