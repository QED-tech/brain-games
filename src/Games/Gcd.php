<?php

namespace Brain\Games;

use Brain\Engine;

class Gcd extends Engine
{
    private string $expression;
    private int $correctAnswer;

    public function __construct()
    {
        parent::__construct("Find the greatest common divisor of given numbers.");
    }

    protected function setExpression(): void
    {
        $a = mt_rand(10, 60);
        $b = mt_rand(10, 60);
        $this->correctAnswer = $this->gcd($a, $b);
        $this->expression = "{$a} {$b}";
    }

    protected function getExpression(): string
    {
        return $this->expression;
    }

    protected function validateAnswer(): bool
    {
        return (int) $this->answer === (int) $this->correctAnswer;
    }

    protected function getCorrectAnswer(): string
    {
        return (string) $this->correctAnswer;
    }

    private function gcd(int $a, int $b): int
    {
        while ($a !== 0 && $b !== 0) {
            if ($a > $b) {
                $a = $a % $b;
            } else {
                $b = $b % $a;
            }
        }

        return $a + $b;
    }
}
