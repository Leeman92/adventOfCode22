<?php

declare(strict_types=1);

namespace App\Solver\Day_03;

use App\Solver\AbstractSolver;
use http\Exception\RuntimeException;
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
        $totalScore = 0;

        foreach ($input as $rucksack) {
            $duplicateItem = $this->extractDuplicateItem($rucksack);
            if (!$duplicateItem) {
                continue;
            }
            $totalScore += $this->calculateScore($duplicateItem);
        }

        $this->printSolution(1, (string) $totalScore);
    }

       /**
        * {@inheritDoc}
        */
       #[NoReturn]
    public function partTwo(array $input): void
    {
        $totalScore = $this->calculateGroupScore($input);

        $this->printSolution(2, (string) $totalScore);
    }

       protected function extractDuplicateItem(string $rucksack): string|false
       {
           $strLength = strlen($rucksack);
           $compartmentLength = (int) ($strLength / 2);
           if ($compartmentLength <= 0) {
               throw new \LogicException('The length of a compartment needs to be greater than 1');
           }

           /** @var array<string> $compartments */
           $compartments = str_split($rucksack, $compartmentLength);
           if (!$compartments ||
               count($compartments) !== 2) {
               throw new RuntimeException('The input was not formed as expected');
           }
           $compartments[0] = (string) reset($compartments);
           $compartments[1] = (string) end($compartments);

           $compartments[0] = mb_str_split($compartments[0]);
           $compartments[1] = mb_str_split($compartments[1]);
           $duplicateContent = array_intersect($compartments[0], $compartments[1]);

           return reset($duplicateContent);
       }

       /**
        * @param array<string> $input
        */
       protected function calculateGroupScore(array $input): int
       {
           $score = 0;
           $elfRucksacks = [];

           foreach ($input as $rucksack) {
               $elfRucksacks[] = mb_str_split($rucksack);
               if (count($elfRucksacks) === 3) {
                   $duplicateItem = array_intersect(...$elfRucksacks);
                   $item = reset($duplicateItem);
                   if (!$item) {
                       continue;
                   }
                   $score += $this->calculateScore($item);
                   $elfRucksacks = [];
               }
           }

           return $score;
       }

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
