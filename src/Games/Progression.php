<?php

namespace Brain\Games;

use Brain\Engine;

class Progression extends Engine
{
    private $correctAnswer;
    private $expression;
    private int $progressionNumber;
    private int $progressionLength;

    public function __construct()
    {
        $this->progressionNumber = mt_rand(2, 5);
        $this->progressionLength = mt_rand(5, 11);
        parent::__construct("What number is missing in the progression?");
    }

    protected function setExpression(): void
    {
        $this->expression = $this->getProgression();
    }

    protected function getExpression()
    {
        return $this->expression;
    }

    protected function validateAnswer(): bool
    {
        return $this->answer === $this->getCorrectAnswer();
    }

    protected function getCorrectAnswer(): string
    {
        return (string) $this->correctAnswer;
    }

    private function getProgression()
    {
        $result = [];
        $number = mt_rand(3, 15);

        for ($i = 0; $i <= $this->progressionLength; $i++) {
            $number += $this->progressionNumber;
            $result[] = $number;
        }

        $randomIndex = mt_rand(0, count($result) - 1);
        $this->correctAnswer = $result[$randomIndex];
        $result[$randomIndex] = '..';

        return implode(' ', $result);
    }
}
