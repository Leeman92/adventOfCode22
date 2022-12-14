<?php

declare(strict_types=1);

namespace App\Solver\Utilities\Matcher;

/**
 * @inheritDoc
 */
class Scissors extends AbstractMatcher
{
    /**
     * @inheritDoc
     */
    public string $winsAgainst = Paper::class;

    /**
     * @inheritDoc
     */
    public string $losesAgainst = Rock::class;

    /**
     * @inheritDoc
     */
    protected int $score = 3;
}
