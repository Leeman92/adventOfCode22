<?php

declare(strict_types=1);

namespace App\Solver\Day_01;

use App\Exception\InputNotFoundException;
use App\Solver\AbstractSolver;
use JetBrains\PhpStorm\NoReturn;

/**
 * @inheritDoc
 */
class Solver extends AbstractSolver
{
    /**
     * @inheritDoc
     */
    #[NoReturn] public function solve(): void
    {
        $input = $this->loadPuzzleInputAsArray();

        // Check if the last entry is a linebreak if not, add it so it's easier to calculate it as a separate elf
        $lastEntry = end($input);
        if ($lastEntry !== '') {
            $input[] = '';
        }

        $elvesRationing = $this->calculateElvesRations($input);

        $this->partOne($elvesRationing);
        $this->partTwo($elvesRationing);
    }

    /**
     * @param array<string> $input
     * @return array<string>
     */
    protected function calculateElvesRations(array $input): array
    {
        $elves = [];
        $calories = 0;
        foreach ($input as $carriedCalories) {
            if ($carriedCalories === "") {
                $elves[] = $calories;
                $calories = 0;
                continue;
            }
            $calories += (int) $carriedCalories;
        }


        uasort($elves, function ($a, $b) {
            return $b <=> $a;
        });

        $transformedElves = [];
        foreach ($elves as $carriedCalories) {
            $transformedElves[] = (string) $carriedCalories;
        }

        return $transformedElves;
    }

    /**
     * @inheritDoc
     */
    #[NoReturn] public function partOne(array $input): void
    {
        $this->printSolution($this->day, 1, (string) reset($input));
    }

    /**
     * @inheritDoc
     */
    #[NoReturn] public function partTwo(array $input): void
    {
        $totalRations = 0;
        $totalRations += (int)array_shift($input);
        $totalRations += (int)array_shift($input);
        $totalRations += (int)array_shift($input);

        $this->printSolution($this->day, 2, (string) $totalRations);
    }
}
