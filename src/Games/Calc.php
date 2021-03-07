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
        $leftOperand = mt_rand(1, 12);
        $rightOperand = mt_rand(1, 12);
        $this->setCorrectAnswer($leftOperand, $rightOperand);
        $this->expression = "{$leftOperand} {$mathSymbol} {$rightOperand}";
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

    private function setCorrectAnswer(int $leftOperand, int $rightOperand): void
    {
        switch ($this->randomIndex) {
            case self::MINUS_INDEX:
                $this->correctAnswer = $leftOperand - $rightOperand;
                break;
            case self::PLUS_INDEX:
                $this->correctAnswer = $leftOperand + $rightOperand;
                break;
            case self::MULTIPLY_INDEX:
                $this->correctAnswer = $leftOperand * $rightOperand;
                break;
        }
    }
}
