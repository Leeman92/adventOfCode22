<?php

declare(strict_types=1);

namespace App;

use App\Exception\InputNotFoundException;
use App\Exception\SolverNotImplementedException;
use App\Solver\SolverInterface;

/**
 * Entry class for the Advent Of Code solving to autoload Solvers for the passed day
 *
 * @author Patrick Lehmann <lehmann.s.patrick@gmail.com>
 */
class PuzzleSolver
{
    protected const SOLVER_CLASS_NAMESPACE = 'App\Solver\Day_%s\Solver';

    /**
     * Automatically instantiates the Solver for the passed Day
     *
     * @param string $day
     * @param bool $testMode
     * @param int $testCount
     * @return void
     *
     * @throws InputNotFoundException
     * @throws SolverNotImplementedException
     */
    public function run(string $day, bool $testMode, int $testCount): void
    {
        $className = sprintf(self::SOLVER_CLASS_NAMESPACE, $day);
        if (!class_exists($className)) {
            throw new SolverNotImplementedException($day);
        }

        $solver = new $className($day, $testMode);

        for ($i = 1; $i <= $testCount; $i++) {
            /** @var SolverInterface $solver */
            $solver->solve($i);
        }
    }
}
