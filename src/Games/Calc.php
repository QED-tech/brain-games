<?php

namespace Brain\Games;

use Brain\Engine;

class Calc extends Engine
{
    private string $expression;
    private int $correctAnswer;
    private int $randomIndex;
    private const MINUS_INDEX = 1;
    private const PLUS_INDEX = 2;
    private const MULTIPLY_INDEX = 3;

    private array $mathSymbols = [
        self::MINUS_INDEX => '-',
        self::PLUS_INDEX => '+',
        self::MULTIPLY_INDEX => '*'
    ];

    public function __construct()
    {
        parent::__construct('What is the result of the expression?');
    }

    protected function getExpression(): string
    {
        return $this->expression;
    }

    protected function setExpression(): void
    {
        $this->setRandomIndex();
        $mathSymbol = $this->mathSymbols[$this->randomIndex];
        $a = mt_rand(1, 12);
        $b = mt_rand(1, 12);
        $this->setCorrectAnswer($a, $b);
        $this->expression = "{$a} {$mathSymbol} {$b}";
    }

    protected function validateAnswer(): bool
    {
        return (int) $this->answer === (int) $this->correctAnswer;
    }

    protected function getCorrectAnswer(): string
    {
        return (string) $this->correctAnswer;
    }


    private function setRandomIndex(): void
    {
        $this->randomIndex = mt_rand(1, 3);
    }

    private function setCorrectAnswer(int $a, int $b): void
    {
        switch ($this->randomIndex) {
            case self::MINUS_INDEX:
                $this->correctAnswer = $a - $b;
                break;
            case self::PLUS_INDEX:
                $this->correctAnswer = $a + $b;
                break;
            case self::MULTIPLY_INDEX:
                $this->correctAnswer = $a * $b;
                break;
        }
    }
}
