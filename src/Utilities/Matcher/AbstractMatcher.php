<?php

declare(strict_types=1);

namespace App\Utilities\Matcher;

use LogicException;

/**
 * Abstract Matcher of the possible moves to solve Rock Paper Scissors
 *
 * @author Patrick Lehmann <lehmann.s.patrick@gmail.com>
 */
class AbstractMatcher implements MatcherInterface
{
    /**
     * Counter to the given Move
     * @var string
     */
    protected string $counter;

    /**
     * Representation of Move by other elf
     * @var string
     */
    protected string $representation;

    /**
     * Score you gain when playing that move
     * @var int
     */
    protected int $score;

    /**
     * What Class this move can win against
     * @var string
     */
    public string $winsAgainst;

    /**
     * What Class this move can lose against
     * @var string
     */
    public string $losesAgainst;

    /**
     * Points you gain when losing a round
     * @var int
     */
    protected int $pointsOnLoss = 0;

    /**
     * Points you gain when drawing a round
     * @var int
     */
    protected int $pointsOnDraw = 3;

    /**
     * Points you gain when winning a round
     * @var int
     */
    protected int $pointsOnWin = 6;

    /**
     * @inheritDoc
     */
    public function isWin(string $input): bool
    {
        return $input === $this->counter;
    }

    /**
     * @inheritDoc
     */
    public function isDraw(string $input): bool
    {
        return $input === $this->representation;
    }

    /**
     * @inheritDoc
     */
    public function evaluate(AbstractMatcher $move): int
    {
        if ($move instanceof $this->winsAgainst) {
            return $this->pointsOnWin;
        }

        if ($move instanceof $this->losesAgainst) {
            return $this->pointsOnLoss;
        }

        if ($move instanceof $this) {
            return $this->pointsOnDraw;
        }

        throw new LogicException("No condition programmed for this case. How did this happen?!");
    }

    /**
     * @inheritDoc
     */
    public function getScore(): int
    {
        return $this->score;
    }
}