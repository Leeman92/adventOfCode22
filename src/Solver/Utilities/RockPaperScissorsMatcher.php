<?php

namespace App\Solver\Utilities;

use App\Solver\Utilities\Matcher\AbstractMatcher;
use App\Solver\Utilities\Matcher\Paper;
use App\Solver\Utilities\Matcher\Rock;
use App\Solver\Utilities\Matcher\Scissors;
use LogicException;

class RockPaperScissorsMatcher
{
    public function evaluate(string $round, bool $secondPart = false): int
    {
        $input = explode(' ', $round);
        $enemyMove = $this->getMatcher(reset($input));
        $yourMove = $this->getMatcher(end($input), reset($input), $secondPart);

        $score = $yourMove->getScore();
        $score += $yourMove->evaluate($enemyMove);

        return $score;
    }

    protected function getMatcher(string $input, string $enemyMove = '', bool $secondPart = false): AbstractMatcher
    {
        $className = $this->getMatcherPartOne($input);
        if ($secondPart) {
            $className = $this->getMatcherPartTwo($input, $enemyMove);
        }

        return new $className();
    }

    protected function getMatcherPartOne(string $input): string
    {
        return match ($input) {
            'A', 'X' => Rock::class,
            'B', 'Y' => Paper::class,
            'C', 'Z' => Scissors::class,
            default => throw new LogicException("Wrong type"),
        };
    }

    protected function getMatcherPartTwo(string $input, string $enemyMove): string
    {
        return match ($enemyMove) {
            'A' => $this->evaluatePartTwoClassName($input, new Rock()),
            'B' => $this->evaluatePartTwoClassName($input, new Paper()),
            'C' => $this->evaluatePartTwoClassName($input, new Scissors()),
            default => '',
        };

    }

    protected function evaluatePartTwoClassName(string $input, AbstractMatcher $matcher): string
    {
        return match ($input) {
            'X' => $matcher->winsAgainst,
            'Y' => $matcher::class,
            'Z' => $matcher->losesAgainst,
            default => '',
        };
    }
}