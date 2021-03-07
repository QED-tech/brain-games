<?php

namespace Brain\Games;

use Brain\Engine;

class Prime extends Engine
{
    private $expression;


    public function __construct()
    {
        parent::__construct('Answer "yes" if given number is prime. Otherwise answer "no".');
    }

    protected function getCorrectAnswer(): string
    {
        return $this->answerToBoolean() === true ? 'no' : 'yes';
    }

    protected function validateAnswer(): bool
    {
        return $this->answerToBoolean() === $this->isPrime();
    }


    protected function setExpression(): void
    {
        $this->expression = mt_rand(3, 22);
    }

    protected function getExpression(): int
    {
        return $this->expression;
    }


    private function isPrime(): bool
    {
        $prime = true;
        if ($this->expression === 2) {
            return true;
        }

        for ($i = 2; $i < $this->expression; $i++) {
            if (($this->expression % $i) === 0) {
                $prime = false;
                break;
            }
        }

        return $prime;
    }
}
