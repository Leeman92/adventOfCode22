<?php

namespace App\Solver\Utilities\Matcher;

class Scissors extends AbstractMatcher
{
    public string $winsAgainst = Paper::class;
    public string $losesAgainst = Rock::class;
    protected int $score = 3;
}