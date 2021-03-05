<?php

namespace Brain\Games;

use function cli\line;
use function cli\prompt;

class Even extends AbstractGame
{
    private Cli $cli;
    private int $number;
    private string $answer;
    private int $correctCount;

    public const MAX_RETRY = 3;

    public function __construct()
    {
        $this->correctCount = 0;
        $this->cli = new Cli();
    }

    public function process()
    {
        $this->cli->greetingUser();
        $this->sleep();
        $this->writeRules();
        $this->retryGame();
        $this->checkWin();
    }

    private function retryGame(): void
    {
        for ($i = 0; $i < self::MAX_RETRY; $i++) {
            $this->sleep();
            $this->getQuestion();
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

    private function checkWin(): void
    {
        if ($this->correctCount === self::MAX_RETRY) {
            $this->congratulateUser($this->cli->getName());
        }
    }

    private function getCorrectAnswer()
    {
        return $this->answerToBoolean() === true ? 'no' : 'yes';
    }


    private function writeRules(): void
    {
        line('Answer "yes" if the number is even, otherwise answer "no".');
    }

    private function getAnswer(): void
    {
        $this->answer = prompt('Your answer');
    }

    private function validateAnswer(): bool
    {
        return $this->answerToBoolean() === $this->isEven();
    }

    private function answerToBoolean(): bool
    {
        switch (mb_strtolower($this->answer)) {
            case 'yes':
                return true;
            case 'no':
                return false;
            default:
                return false;
        }
    }

    private function isEven(): bool
    {
        return $this->number % 2 === 0;
    }

    private function getQuestion(): void
    {
        $this->setNumber();
        $question = "Question: " . $this->getNumber();
        line($question);
    }

    private function setNumber(): void
    {
        $this->number = mt_rand(3, 22);
    }

    private function getNumber(): int
    {
        return $this->number;
    }
}
