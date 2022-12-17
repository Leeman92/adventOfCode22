<?php

declare(strict_types=1);

namespace App\Services\RockPaperScissorsService;

/**
 * {@inheritDoc}
 */
class Paper extends AbstractGameMove
{
    /**
     * {@inheritDoc}
     */
    public string $winsAgainst = Rock::class;

    /**
     * {@inheritDoc}
     */
    public string $losesAgainst = Scissors::class;

    /**
     * {@inheritDoc}
     */
    protected int $score = 2;
}
