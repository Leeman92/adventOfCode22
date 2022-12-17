<?php

declare(strict_types=1);

namespace App\Services\CraneService;

use App\Exception\CraneMoveException;
use App\Exception\CrateStackEmptyException;

/**
 * An overcomplicated representation for a stack of crates
 * This could also be just a simple array. However, I am not doing Advent of Code to go easy on me
 *
 * @author Patrick Lehmann <lehmann.s.patrick@gmail.com>
 */
class CrateStack
{
    /**
     * A representation of the Crates available on this CrateStack.
     * @var array<string>
     */
    public array $crates = [];

    /**
     * Adds Crates to the top of the current stack
     *
     * @param array<string> $crates
     * @param bool $setup
     * @return void
     */
    public function addCrates(array $crates, bool $setup = false): void
    {
        if (empty($crates)) {
            return;
        }

        /*
         * In case of the setup I have to merge them differently as I parse from top to bottom not bottom to top
         * But I will move them later from top and add them to the top
         */
        if ($setup) {
            $this->crates = array_merge($this->crates, $crates);
            return;
        }

        $this->crates = array_merge($crates, $this->crates);
    }

    /**
     * Moves $amount of Crates from the top of the CrateStack
     *
     * @param int $amount
     * @return array<string>
     */
    public function moveCrates(int $amount): array
    {
        if (count($this->crates) === 0) {
            return [];
        }

        if (count($this->crates) < $amount) {
            $amount = count($this->crates);
        }

        $preChangedCrates = $this->crates;
        $removedCrates = array_slice($this->crates, 0, $amount);
        $this->crates = array_slice($this->crates, $amount);
        return $removedCrates;
    }

    /**
     * Returns the Letter of the topmost crate.
     * If the CrateStack is empty it will throw a CrateStackEmptyException
     *
     * @return string
     * @throws CrateStackEmptyException
     */
    public function getTopCrateLetter(): string
    {
        $crate = reset($this->crates);
        if (!$crate) {
            throw new CrateStackEmptyException();
        }

        return $crate;
    }
}
