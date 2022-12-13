<?php
declare(strict_types=1);

namespace App\Solver\Day_02;

use App\Solver\AbstractSolver;
use App\Solver\Utilities\RockPaperScissorsMatcher;
use JetBrains\PhpStorm\NoReturn;

/**
 * @inheritDoc
 */
class Solver extends AbstractSolver
{
    /**
     * Solution for Part One. Return the elf with the most food
     *
     * @param array $input
     * @return void
     */
    #[NoReturn] public function partOne(array $input): void
    {
        $rpsMatcher = new RockPaperScissorsMatcher();
        $totalScore = 0;

        foreach ($input as $round) {
            $totalScore += $rpsMatcher->evaluate($round);
        }

        $this->printSolution($this->day, 1, (string)$totalScore);
    }

    /**
     * Solution for Part One. Return the elf with the most food
     *
     * @param array $input
     * @return void
     */
    #[NoReturn] public function partTwo(array $input): void
    {
        $rpsMatcher = new RockPaperScissorsMatcher();
        $totalScore = 0;

        foreach ($input as $round) {
            $totalScore += $rpsMatcher->evaluate($round, true);
        }

        $this->printSolution($this->day, 2, (string)$totalScore);
    }
}