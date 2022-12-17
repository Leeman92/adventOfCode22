<?php

declare(strict_types=1);

namespace App\Services\SectionsService;

use JetBrains\PhpStorm\NoReturn;

class Section
{
    /**
     * Lower Bound of the section.
     */
    protected int $lowerBound;

    /**
     * Upper Bound of the section.
     */
    protected int $upperBound;

    #[NoReturn]
    public function __construct(string $sectionBounds)
    {
        $bounds = explode('-', $sectionBounds);
        if (count($bounds) !== 2) {
            throw new \LogicException(sprintf('There have to be two coordinates defined for a section! %s', $sectionBounds));
        }

        $this->lowerBound = (int) reset($bounds);
        $this->upperBound = (int) end($bounds);
    }

       public function getLowerBound(): int
       {
           return $this->lowerBound;
       }

       public function getUpperBound(): int
       {
           return $this->upperBound;
       }
}
