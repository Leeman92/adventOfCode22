<?php
declare(strict_types=1);

namespace App\Solver\Utilities\Matcher;

use LogicException;

interface MatcherInterface
{
    /**
     * Evaluates if the Move gets beaten
     *
     * @param string $input
     * @return bool
     */
    public function isWin(string $input): bool;

    /**
     * Evaluates if the round is a draw
     *
     * @param string $input
     * @return bool
     */
    public function isDraw(string $input): bool;

    /**
     * Scores the current round
     *
     * @param AbstractMatcher $move
     * @return int|LogicException
     */
    public function evaluate(AbstractMatcher $move): int|LogicException;

    /**
     * Returns the score for the given move
     * @return int
     */
    public function getScore(): int;
}