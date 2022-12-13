<?php

namespace App\Solver;

use App\Exception\InputNotFoundException;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class that contains the solution for the specific day
 * @author Patrick Lehmann <lehmann.s.patrick@gmail.com>
 */
abstract class AbstractSolver implements SolverInterface
{
    protected const INPUT_PATH = __DIR__ . '/../resources/input/';
    protected const PUZZLE_FILE_NAME = 'input.txt';
    protected const PUZZLE_FILE_TEST_NAME = 'test.input.txt';

    /**
     * Sets the day and testmode when instantiating
     *
     * @param string $day
     * @param bool $testMode
     */
    public function __construct(protected string $day, protected bool $testMode)
    {
    }

    /**
     * @inheritDoc
     */
    #[NoReturn] public function solve(): void
    {
        $input = $this->loadPuzzleInputAsArray();

        $this->partOne($input);

        $this->partTwo($input);
    }

    /**
     * @inheritDoc
     */
    public function loadPuzzleInputAsArray(): array
    {
        $fileName = self::PUZZLE_FILE_NAME;
        if ($this->testMode) {
            $fileName = self::PUZZLE_FILE_TEST_NAME;
        }

        $pathToFile= self::INPUT_PATH . $this->day . '/'. $fileName;

        if (!file_exists($pathToFile)) {
            throw new InputNotFoundException($pathToFile);
        }

        $input = file_get_contents($pathToFile);
        return explode("\r\n", $input);
    }

    #[NoReturn] public function printSolution(string $day, int $part, string $solutionValue): void
    {
        $solutionText = "The solution for day %s part %s is: %s" . PHP_EOL;
        $solutionText = sprintf($solutionText, $day, $part, $solutionValue);
        $spacerText = str_pad("", strlen($solutionText), "=");
        echo $spacerText. PHP_EOL;
        echo $solutionText;
        echo $spacerText. PHP_EOL;
    }

    abstract public function partOne(array $input): void;
    abstract public function partTwo(array $input): void;
}