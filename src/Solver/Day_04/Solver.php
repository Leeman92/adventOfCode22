<?php

declare(strict_types=1);

namespace App\Solver\Day_04;

use App\Services\SectionsService\SectionManager;
use App\Solver\AbstractSolver;
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
        $sectionManager = new SectionManager($input);
        $overlapCount = $sectionManager->getCompleteOverlapCount();

        $this->printSolution(1, (string) $overlapCount);
    }

       /**
        * {@inheritDoc}
        */
       #[NoReturn]
    public function partTwo(array $input): void
    {
        $sectionManager = new SectionManager($input);
        $overlapCount = $sectionManager->getSingleOverlapCount();

        $this->printSolution(2, (string) $overlapCount);
    }
}
