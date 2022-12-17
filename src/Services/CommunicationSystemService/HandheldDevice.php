<?php

declare(strict_types=1);

namespace App\Services\CommunicationSystemService;

use Exception;

class HandheldDevice
{
    /**
     * @var array<string>
     */
    protected array $subroutineAsArray = [];
    public function __construct(protected string|false $subroutine)
    {
        if (!$this->subroutine) {
            throw new Exception('Could not read subroutine Input');
        }
        $this->subroutineAsArray = str_split($this->subroutine);
    }

    public function findStartOfSubroutine(int $markerSize = 4): int
    {
        return $this->findMarker($markerSize);
    }

    public function findStartOfMessage(int $markerSize = 14): int
    {
        return $this->findMarker($markerSize);
    }

    /**
     * Checks the subroutine to find the marker with the given markersize
     *
     * @param int $markerSize
     * @return int
     */
    protected function findMarker(int $markerSize): int
    {
        $controlArray = [];
        for ($i = 0; $i < count($this->subroutineAsArray); $i++) {
            // Add current value to the control
            $controlArray[] = $this->subroutineAsArray[$i];
            // Make sure the value is unique
            $checkUniqueness = array_flip(array_flip($controlArray));
            // If we have unique entries in the size of markerSize, then we found it
            if (count($checkUniqueness) == $markerSize) {
                return $i;
            }

            // We haven't found it. And in case we are already checking markerSize amount of nodes, then remove the first
            if (count($controlArray) === $markerSize) {
                array_shift($controlArray);
            }
        }

        return -1;
    }
}
