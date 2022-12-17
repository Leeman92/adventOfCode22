<?php

declare(strict_types=1);

namespace App\Solver\Day_02;

use App\Solver\AbstractSolver;
use App\Services\RockPaperScissorsService\RockPaperScissorsService;
use JetBrains\PhpStorm\NoReturn;

/**
 * @inheritDoc
 */
class Solver extends AbstractSolver
{
    /**
     * @inheritDoc
     */
    #[NoReturn] public function partOne(array $input): void
    {
        $rpsMatcher = new RockPaperScissorsService();
        $totalScore = 0;

        foreach ($input as $round) {
            $totalScore += $rpsMatcher->evaluate($round);
        }

        $this->printSolution($this->day, 1, (string)$totalScore);
    }

    /**
     * @inheritDoc
     */
    #[NoReturn] public function partTwo(array $input): void
    {
        $rpsMatcher = new RockPaperScissorsService();
        $totalScore = 0;

        foreach ($input as $round) {
            $totalScore += $rpsMatcher->evaluate($round, true);
        }

        $this->printSolution($this->day, 2, (string)$totalScore);
    }
}
