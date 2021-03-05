<?php

namespace Brain\Games;

use function cli\line;

abstract class AbstractGame
{

    public const SLEEP_TIME = 1;

    public function sleep()
    {
        sleep(self::SLEEP_TIME);
    }

    public function congratulateUser($userName): void
    {
        line("Congratulations, %s!", $userName);
    }
}
