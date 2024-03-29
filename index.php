<?php
declare(strict_types=1);

use App\Exception\SolverNotImplementedException;
use App\PuzzleSolver;

include_once "vendor/autoload.php";
/*
 * Parsing of the passed opts to solve for the day and the tests if passed
 */
$arguments = getopt("d:t::c::", ['day:', 'test::', 'testCount::']);
$day = $arguments['d'] ?? $arguments['day'] ?? "01";
$test = $arguments['t'] ?? $arguments['test'] ?? false;
$testCount = $arguments['c'] ?? $arguments['testCount'] ?? 1;
if (is_string($test)) {
    if ($test === "false" || !$test) {
        $test = false;
    } else {
        $test = true;
    }
}

// Runs the puzzlesolver
$puzzleSolver = new PuzzleSolver();
try {
    $puzzleSolver->run($day, $test, (int) $testCount);
} catch (SolverNotImplementedException $e) {
    dd($e->getMessage());
}