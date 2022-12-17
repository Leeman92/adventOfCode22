<?php

declare(strict_types=1);

namespace App\Services\RockPaperScissorsService;

/**
 * {@inheritDoc}
 */
class Scissors extends AbstractGameMove
{
    /**
     * {@inheritDoc}
     */
    public string $winsAgainst = Paper::class;

    /**
     * {@inheritDoc}
     */
    public string $losesAgainst = Rock::class;

    /**
     * {@inheritDoc}
     */
    protected int $score = 3;
}
