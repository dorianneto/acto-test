<?php

namespace App\Rules;

use PHPUnit\Framework\TestCase;

class HandCheckerTest extends TestCase
{

    public function validDataProvider(): array
    {
        return [
            [[4, 'A', 10, 'Q', 6]],
            [[4, 'A', 10, 'Q', 6, 9, 3, 'K']],
        ];
    }

    /**
     * @dataProvider validDataProvider
     */
    public function testIsCheckingValidData(array $value): void
    {
        $attribute = 'hand';

        $rule = new HandChecker();
        $actual = $rule->passes($attribute, $value);

        $this->assertTrue($actual);
    }

    public function invalidDataProvider(): array
    {
        return [
            [[4, 'Z', 10, 'Q', 6]],
            [[42, 'A', 10, 'Q', 6]],
            [[4.2, 'A', 10, 'Q', 6]],
        ];
    }

    /**
     * @dataProvider invalidDataProvider
     */
    public function testIsCheckingInvalidData(array $value): void
    {
        $attribute = 'hand';

        $rule = new HandChecker();
        $actual = $rule->passes($attribute, $value);

        $this->assertFalse($actual);
    }
}
