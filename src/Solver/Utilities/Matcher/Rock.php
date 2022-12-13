<?php
declare(strict_types=1);

namespace App\Solver\Utilities\Matcher;

/**
 * @inheritDoc
 */
class Rock extends AbstractMatcher
{
    /**
     * @inheritDoc
     */
    public string $winsAgainst = Scissors::class;

    /**
     * @inheritDoc
     */
    public string $losesAgainst = Paper::class;

    /**
     * @inheritDoc
     */
    protected int $score = 1;
}