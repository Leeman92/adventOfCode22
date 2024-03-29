<?php

declare(strict_types=1);

namespace App\Services\RockPaperScissorsService;

/**
 * {@inheritDoc}
 */
class Rock extends AbstractGameMove
{
    /**
     * {@inheritDoc}
     */
    public string $winsAgainst = Scissors::class;

    /**
     * {@inheritDoc}
     */
    public string $losesAgainst = Paper::class;

    /**
     * {@inheritDoc}
     */
    protected int $score = 1;
}
