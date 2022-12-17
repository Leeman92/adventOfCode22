<?php

declare(strict_types=1);

namespace App\Solver\Day_05;

use App\Services\CraneService\Crane;
use App\Solver\AbstractSolver;
use JetBrains\PhpStorm\NoReturn;

class Solver extends AbstractSolver
{
    /**
     * {@inheritDoc}
     */
    #[NoReturn]
    public function partOne(array $input): void
    {
        $crane = new Crane();
        $instructions = $crane->initiateCrateStacks($input);
        $crane->parseInstructions($instructions, true);

        $this->printSolution(1, $crane->getSolution());
    }

       /**
        * {@inheritDoc}
        */
       public function partTwo(array $input): void
       {
           $crane = new Crane();
           $instructions = $crane->initiateCrateStacks($input);
           $crane->parseInstructions($instructions, false);

           $this->printSolution(1, $crane->getSolution());
       }
}
