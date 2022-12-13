<?php

namespace App\Solver\Utilities\Matcher;

class Rock extends AbstractMatcher
{
    public string $winsAgainst = Scissors::class;
    public string $losesAgainst = Paper::class;
    protected int $score = 1;
}