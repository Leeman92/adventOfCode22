<?php

namespace App\Solver\Day_06;

use App\Services\CommunicationSystemService\HandheldDevice;
use App\Solver\AbstractSolver;

class Solver extends AbstractSolver
{
    protected HandheldDevice $device;

    /**
     * @inheritDoc
     */
    public function partOne(array $input): void
    {
        $this->device = new HandheldDevice(reset($input));
        $startIndex = $this->device->findStartOfSubroutine();
        // Since PHP is a zero based index count, add one to the solution
        $this->printSolution(1, (string) ($startIndex + 1));
    }

    /**
     * @inheritDoc
     */
    public function partTwo(array $input): void
    {
        $startIndex = $this->device->findStartOfMessage();
        // Since PHP is a zero based index count, add one to the solution
        $this->printSolution(1, (string)($startIndex + 1));
    }
}
