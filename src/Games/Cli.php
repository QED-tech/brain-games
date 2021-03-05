<?php

namespace Brain\Games;

use function cli\line;
use function cli\prompt;

class Cli
{

    private string $name;

    public function greetingUser(): void
    {
        line('Welcome to the Brain Game!');
        $this->name = prompt('May I have your name?');
        line("Hello, %s!", $this->name);
    }


    public function getName()
    {
        return $this->name;
    }
}
