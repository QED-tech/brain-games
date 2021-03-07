<?php

namespace Brain;

use Brain\Games\Cli;

use function cli\line;
use function cli\prompt;

abstract class Engine
{
    protected int $correctCount;
    protected Cli $cli;
    protected const SLEEP_TIME = 1;
    protected const MAX_RETRY = 3;
    protected string $answer;
    protected string $rules;


    protected function __construct(string $rules)
    {
        $this->correctCount = 0;
        $this->cli = new Cli();
        $this->rules = $rules;
    }


    public function process(): void
    {
        $this->cli->greetingUser();
        $this->sleep();
        $this->writeRules($this->rules);
        $this->retryGame();
        $this->checkWin();
    }

    protected function answerToBoolean(): bool
    {
        return mb_strtolower($this->answer) === 'yes';
    }

    protected function sleep()
    {
        sleep(self::SLEEP_TIME);
    }

    protected function congratulateUser(string $userName): void
    {
        line("Congratulations, %s!", $userName);
    }

    protected function getAnswer(): void
    {
        $this->answer = prompt('Your answer');
    }

    protected function writeRules(string $rules): void
    {
        line($rules);
    }

    protected function checkWin(): void
    {
        if ($this->correctCount === self::MAX_RETRY) {
            $this->congratulateUser($this->cli->getName());
        }
    }

    protected function getQuestion($expression): void
    {
        $question = "Question: " . $expression;
        line($question);
    }

    protected function retryGame(): void
    {
        for ($i = 0; $i < self::MAX_RETRY; $i++) {
            $this->sleep();
            $this->setExpression();
            $this->getQuestion($this->getExpression());
            $this->getAnswer();
            if (!$this->validateAnswer()) {
                line("'{$this->answer}' is wrong answer ;(. Correct answer was '{$this->getCorrectAnswer()}'.");
                line("Let's try again, %s!", $this->cli->getName());
                break;
            }

            if ($this->validateAnswer()) {
                $this->correctCount++;
                line('Correct!');
            }
        }
    }

    abstract protected function setExpression(): void;
    abstract protected function getExpression();
    abstract protected function validateAnswer(): bool;
    abstract protected function getCorrectAnswer(): string;
}
