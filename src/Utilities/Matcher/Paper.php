<?php

declare(strict_types=1);

namespace App\Utilities\Matcher;

/**
 * @inheritDoc
 */
class Paper extends AbstractMatcher
{
    /**
     * @inheritDoc
     */
    public string $winsAgainst = Rock::class;

    /**
     * @inheritDoc
     */
    public string $losesAgainst = Scissors::class;

    /**
     * @inheritDoc
     */
    protected int $score = 2;
}
