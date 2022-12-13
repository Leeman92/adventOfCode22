<?php

namespace App\Solver\Utilities\Matcher;

class Paper extends AbstractMatcher
{
    public string $winsAgainst = Rock::class;
    public string $losesAgainst = Scissors::class;
   protected int $score = 2;
}