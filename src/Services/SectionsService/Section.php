<?php

declare(strict_types=1);

namespace App\Services\SectionsService;

use JetBrains\PhpStorm\NoReturn;
use LogicException;

class Section
{
    /**
     * Lower Bound of the section
     * @var int
     */
    protected int $lowerBound;

    /**
     * Upper Bound of the section
     * @var int
     */
    protected int $upperBound;

    /**
     * @param string $sectionBounds
     */
    #[NoReturn] public function __construct(string $sectionBounds)
    {
        $bounds = explode('-', $sectionBounds);
        if (count($bounds) !== 2) {
            throw new LogicException(sprintf('There have to be two coordinates defined for a section! %s', $sectionBounds));
        }

        $this->lowerBound = (int) reset($bounds);
        $this->upperBound = (int) end($bounds);
    }

    /**
     * @return int
     */
    public function getLowerBound(): int
    {
        return $this->lowerBound;
    }

    /**
     * @return int
     */
    public function getUpperBound(): int
    {
        return $this->upperBound;
    }
}
