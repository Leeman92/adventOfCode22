<?php
declare(strict_types=1);

namespace App\Solver\Day_03;

use App\Solver\AbstractSolver;
use JetBrains\PhpStorm\NoReturn;

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
        $totalScore = 0;

        foreach ($input as $rucksack) {
            $duplicateItem = $this->extractDuplicateItem($rucksack);
            $totalScore += $this->calculateScore($duplicateItem);
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
        $totalScore = $this->calculateGroupScore($input);

        $this->printSolution($this->day, 2, (string)$totalScore);
    }

    /**
     * @param string $rucksack
     * @return string
     */
    protected function extractDuplicateItem(string $rucksack): string
    {
        $compartments = str_split($rucksack, strlen($rucksack) / 2);
        $compartments[0] = mb_str_split($compartments[0]);
        $compartments[1] = mb_str_split($compartments[1]);
        $duplicateContent = array_intersect($compartments[0], $compartments[1]);
        return reset($duplicateContent);
    }

    protected function calculateGroupScore(array $input): int
    {
        $score = 0;
        $elfRucksacks = [];

        foreach ($input as $rucksack) {
            $elfRucksacks[] = mb_str_split($rucksack);
            if (count($elfRucksacks) === 3) {
                $duplicateItem = array_intersect(...$elfRucksacks);
                $score += $this->calculateScore(reset($duplicateItem));
                $elfRucksacks = [];
            }
        }

        return $score;
    }


    /**
     * @param string $duplicateItem
     * @return int
     */
    protected function calculateScore(string $duplicateItem): int
    {
        if (ctype_lower($duplicateItem)) {
            $scoreDecrease = 96; // lowercase should go from 1 - 26. they go from 97 upwards tho
        } else {
            $scoreDecrease = (65 - 27); // uppercase should go from 27 - 52. they go from 65 upwards tho
        }
        return ord($duplicateItem) - $scoreDecrease;
    }
}