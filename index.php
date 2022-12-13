<?php
declare(strict_types=1);

use App\Exception\SolverNotImplementedException;
use App\PuzzleSolver;

include_once "vendor/autoload.php";
$arguments = getopt("d:t::", ['day:', 'test::']);
$day = $arguments['d'] ?? $arguments['day'] ?? "01";
$test = $arguments['t'] ?? $arguments['test'] ?? false;
if (is_string($test)) {
    if ($test === "false" || !$test) {
        $test = false;
    } else {
        $test = true;
    }
}

$puzzleSolver = new PuzzleSolver();
try {
    $puzzleSolver->run($day, $test);
} catch (SolverNotImplementedException $e) {
    dd($e->getMessage());
}