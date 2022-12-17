<?php

declare(strict_types=1);

namespace App\Services\CraneService;

use App\Exception\CraneMoveException;
use App\Exception\CrateStackEmptyException;
use TypeError;

/**
 * @author Patrick Lehmann <lehmann.s.patrick@gmail.com>
 */
interface CraneInterface
{
    /**
     * Creates the initial setup for the Crate Stacks based on the input.
     * Returns Move Instructions
     *
     * @param array<string> $input
     *
     * @return array<int, array<int, string>>
     */
    public function initiateCrateStacks(array $input): array;

    /**
     * @return string
     * @throws CrateStackEmptyException
     */
    public function getSolution(): string;
}
