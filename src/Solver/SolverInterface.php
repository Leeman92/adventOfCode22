<?php
declare(strict_types=1);

namespace App\Solver;

use App\Exception\InputNotFoundException;
use JetBrains\PhpStorm\NoReturn;

interface SolverInterface
{

    /**
     * Solves the Puzzle for the given day
     *
     * @return void
     * @throws InputNotFoundException
     */
    public function solve(): void;

    /**
     * Loads the puzzle Input and puts every line in a separate array value
     *
     * @return array
     *
     * @throws InputNotFoundException
     */
    public function loadPuzzleInputAsArray(): array;

    /**
     * Prints the solution to the cli
     *
     * @param string $day
     * @param int $part
     * @param string $solutionValue
     *
     * @return void
     */
    #[NoReturn] public function printSolution(string $day, int $part, string $solutionValue): void;

    public function partOne(array $input): void;
    public function partTwo(array $input): void;
}