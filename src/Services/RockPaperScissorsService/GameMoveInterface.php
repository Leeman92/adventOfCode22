<?php

declare(strict_types=1);

namespace App\Services\RockPaperScissorsService;

interface GameMoveInterface
{
    /**
     * Evaluates if the Move gets beaten.
     */
    public function isWin(string $input): bool;

    /**
     * Evaluates if the round is a draw.
     */
    public function isDraw(string $input): bool;

    /**
     * Scores the current round.
     */
    public function evaluate(AbstractGameMove $move): int|\LogicException;

    /**
     * Returns the score for the given move.
     */
    public function getScore(): int;
}
