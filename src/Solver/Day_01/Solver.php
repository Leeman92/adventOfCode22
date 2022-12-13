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
     * @throws InputNotFoundException
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
     * Calculate how many each elf is carrying.
     * Split elves by empty lines in the puzzle input
     *
     * @param array $input
     * @return array
     */
    protected function calculateElvesRations(array $input): array
    {
        $elves = [];
        $calories = 0;
        $elfIndex = 0;
        foreach ($input as $carriedCalories) {
            if ($carriedCalories === "") {
                $elves[$elfIndex] = $calories;
                $calories = 0;
                $elfIndex++;
                continue;
            }
            $calories += $carriedCalories;
        }

        uasort($elves, function ($a, $b) {
            return $b <=> $a;
        });

        return $elves;
    }

    /**
     * Solution for Part One. Return the elf with the most food
     *
     * @param array $input
     * @return void
     */
    #[NoReturn] public function partOne(array $input): void
    {
        $this->printSolution($this->day, 1, (string) reset($input));
    }

    /**
     * Solution for Part One. Return the elf with the most food
     *
     * @param array $input
     * @return void
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