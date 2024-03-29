<?php

declare(strict_types=1);

namespace App\Solver\Day_02;

use App\Services\RockPaperScissorsService\RockPaperScissorsService;
use App\Solver\AbstractSolver;
use JetBrains\PhpStorm\NoReturn;

/**
 * {@inheritDoc}
 */
class Solver extends AbstractSolver
{
    /**
     * {@inheritDoc}
     */
    #[NoReturn]
    public function partOne(array $input): void
    {
        $rpsMatcher = new RockPaperScissorsService();
        $totalScore = 0;

        foreach ($input as $round) {
            $totalScore += $rpsMatcher->evaluate($round);
        }

        $this->printSolution(1, (string) $totalScore);
    }

       /**
        * {@inheritDoc}
        */
       #[NoReturn]
    public function partTwo(array $input): void
    {
        $rpsMatcher = new RockPaperScissorsService();
        $totalScore = 0;

        foreach ($input as $round) {
            $totalScore += $rpsMatcher->evaluate($round, true);
        }

        $this->printSolution(2, (string) $totalScore);
    }
}
