<?php

declare(strict_types=1);

namespace App\Services\SectionsService;

/**
 * Manager for the sections to handle all the logic for day 4s puzzle
 *
 * @author Patrick Lehmann <lehmann.s.patrick@gmail.com>
 */
class SectionManager
{
    /**
     * @var array<Section>
     */
    protected array $sections;

    /**
     * @param array<string> $sections
     */
    public function __construct(array $sections)
    {
        foreach ($sections as $section) {
            $splitSections = explode(',', $section);
            foreach ($splitSections as $splitSection) {
                $this->sections[] = new Section($splitSection);
            }
        }
    }

    /**
     * @return int
     */
    public function getCompleteOverlapCount(): int
    {
        $overlapCount = 0;
        for ($i = 0; $i < count($this->sections); $i += 2) {
            $firstSection = $this->sections[$i];
            $secondSection = $this->sections[$i + 1];

            if ($this->isOverlapping($firstSection, $secondSection) ||
                $this->isOverlapping($secondSection, $firstSection)) {
                $overlapCount++;
            }
        }

        return $overlapCount;
    }

    /**
     * @return int
     */
    public function getSingleOverlapCount(): int
    {
        $overlapCount = 0;
        for ($i = 0; $i < count($this->sections); $i += 2) {
            $firstSection = $this->sections[$i];
            $secondSection = $this->sections[$i + 1];

            if ($this->isPartlyOverlapping($firstSection, $secondSection)) {
                $overlapCount++;
            }
        }

        return $overlapCount;
    }

    /**
     * Checks if the firstSection is within the bounds of secondSection
     *
     * @param Section $firstSection
     * @param Section $secondSection
     * @return bool
     */
    protected function isOverlapping(Section $firstSection, Section $secondSection): bool
    {
        if ($firstSection->getUpperBound() < $secondSection->getLowerBound()) {
            return false;
        }

        if ($firstSection->getLowerBound() < $secondSection->getLowerBound()) {
            return false;
        }

        if ($firstSection->getUpperBound() > $secondSection->getUpperBound()) {
            return false;
        }

        return true;
    }

    /**
     * Checks if the firstSection is within the bounds of secondSection
     *
     * @param Section $firstSection
     * @param Section $secondSection
     * @return bool
     */
    protected function isPartlyOverlapping(Section $firstSection, Section $secondSection): bool
    {
        if ($firstSection->getUpperBound() >= $secondSection->getLowerBound() &&
            $firstSection->getLowerBound() <= $secondSection->getUpperBound()) {
            return true;
        }

        return false;
    }
}
