<?php

namespace App\Solver;

use App\Exception\InputNotFoundException;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class that contains the solution for the specific day.
 *
 * @author Patrick Lehmann <lehmann.s.patrick@gmail.com>
 */
abstract class AbstractSolver implements SolverInterface
{
    protected const INPUT_PATH = __DIR__.'/../resources/input/';
    protected const PUZZLE_FILE_NAME = 'input.txt';
    protected const PUZZLE_FILE_TEST_NAME = 'test%s.input.txt';

    /**
     * Sets the day and testmode when instantiating.
     */
    public function __construct(
        protected string $day,
        protected bool $testMode
    ) {
    }

    /**
     * {@inheritDoc}
     */
    #[NoReturn]
 public function solve(int $testId = 1): void
 {
     $input = $this->loadPuzzleInputAsArray($testId);
     if ($this->testMode) {
         var_dump('Running Test '.$testId);
     }

     $this->partOne($input);

     $this->partTwo($input);
 }

    /**
     * {@inheritDoc}
     */
    public function loadPuzzleInputAsArray(int $testId): array
    {
        $fileName = self::PUZZLE_FILE_NAME;
        if ($this->testMode) {
            $fileName = sprintf(self::PUZZLE_FILE_TEST_NAME, $testId > 1 ? (string) $testId : '');
        }

        $pathToFile = self::INPUT_PATH.$this->day.'/'.$fileName;

        if (!file_exists($pathToFile)) {
            throw new InputNotFoundException($pathToFile);
        }

        $input = file_get_contents($pathToFile);
        if (!$input) {
            throw new \LogicException(sprintf('Input file for day %s was empty!', $this->day));
        }

        return explode("\r\n", $input);
    }

    #[NoReturn]
 public function printSolution(int $part, string $solutionValue): void
 {
     $solutionText = 'The solution for day %s part %s is: %s'.PHP_EOL;
     $solutionText = sprintf($solutionText, $this->day, $part, $solutionValue);
     $spacerText = str_pad('', strlen($solutionText), '=');
     echo $spacerText.PHP_EOL;
     echo $solutionText;
     echo $spacerText.PHP_EOL;
 }

    abstract public function partOne(array $input): void;

    abstract public function partTwo(array $input): void;
}
