<?php

namespace Brain\Games;

use Brain\Engine;

class Even extends Engine
{
    private int $expression;

    public function __construct()
    {
        parent::__construct();
    }

    public function process(): void
    {
        $this->cli->greetingUser();
        $this->sleep();
        $this->writeRules('Answer "yes" if the number is even, otherwise answer "no".');
        $this->retryGame();
        $this->checkWin();
    }

    protected function getCorrectAnswer(): string
    {
        return $this->answerToBoolean() === true ? 'no' : 'yes';
    }

    protected function validateAnswer(): bool
    {
        return $this->answerToBoolean() === $this->isEven();
    }

    private function isEven(): bool
    {
        return $this->expression % 2 === 0;
    }

    protected function setExpression(): void
    {
        $this->expression = mt_rand(3, 22);
    }

    protected function getExpression(): int
    {
        return $this->expression;
    }

    private function answerToBoolean(): bool
    {
        return mb_strtolower($this->answer) === 'yes';
    }
}
