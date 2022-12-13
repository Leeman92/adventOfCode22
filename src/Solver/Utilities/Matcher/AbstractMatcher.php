<?php

namespace App\Solver\Utilities\Matcher;

use LogicException;

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

    protected int $score;
    public string $winsAgainst;
    public string $losesAgainst;
    protected int $pointsOnLoss = 0;
    protected int $pointsOnDraw = 3;
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