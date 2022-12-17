<?php

declare(strict_types=1);

namespace App\Services\CraneService;

use App\Exception\CrateStackEmptyException;
use JetBrains\PhpStorm\NoReturn;

/**
 * {@inheritDoc}
 */
class Crane implements CraneInterface
{
    /**
     * @var array<CrateStack>
     */
    protected array $crateStacks = [];

    /**
     * {@inheritDoc}
     */
    protected function moveCrateStack(int $targetStackIndex, int $sourceStackIndex, int $amount): void
    {
        $targetStack = $this->crateStacks[$targetStackIndex];
        $sourceStack = $this->crateStacks[$sourceStackIndex];

        $crates = $sourceStack->moveCrates($amount);
        $targetStack->addCrates($crates);
    }

    /**
     * {@inheritDoc}
     */
    public function initiateCrateStacks(array $input): array
    {
        $preparedLines = [];
        foreach ($input as $line) {
            $preparedLines[] = array_filter(explode('[', $line));
        }

        [$boxSetup, $instructions] = $this->normaliseLines($preparedLines);
        $this->setupBoxes($boxSetup);

        return $instructions;
    }

    /**
     * @param array<int, array<int, string>> $input
     *
     * @return array<int, array<int, array<int, string>>>
     */
    protected function normaliseLines(array $input): array
    {
        $sliceKey = -1;
        $emptyBoxPattern = '/(\s{4})+/';
        $addEmptyStacksAtIndices = [];
        foreach ($input as $lineIndex => $line) {
            if (empty($line)) {
                $sliceKey = $lineIndex;
            }
            foreach ($line as $valIndex => $value) {
                if (preg_match($emptyBoxPattern, $value)) {
                    $emptyStacks = -1;
                    $value = str_replace('    ', '', $value, $emptyStacks);
                    if ($emptyStacks >= 1 && empty($value)) {
                        --$emptyStacks;
                    }
                    if ($emptyStacks > 0) {
                        $addEmptyStacksAtIndices[$lineIndex][$valIndex] = $emptyStacks;
                    }
                }
                $input[$lineIndex][$valIndex] = trim($value, '] ');
            }

            $input[$lineIndex] = array_values($input[$lineIndex]);
        }

        $boxSetup = array_slice($input, 0, $sliceKey);
        $craneInstructions = array_slice($input, $sliceKey + 1, count($input));

        foreach ($addEmptyStacksAtIndices as $lineIndex => $emptyStacks) {
            krsort($emptyStacks);
            foreach ($emptyStacks as $index => $amount) {
                $offset = 0;
                if (empty($boxSetup[$lineIndex][0])) {
                    ++$offset;
                }
                for ($i = 0; $i < $amount; ++$i) {
                    array_splice($boxSetup[$lineIndex], $index + $offset, 0, '');
                }
            }
        }

        return [$boxSetup, $craneInstructions];
    }

    /**
     * @param array<int, array<int,string>>|false $boxSetup
     *
     * @throws \Exception
     */
    #[NoReturn]
 protected function setupBoxes(array|false $boxSetup): void
 {
     if (!$boxSetup) {
         throw new \Exception('Something went wrong wen parsing the boxSetup');
     }

     $boxSetupString = array_pop($boxSetup)[0];
     if (!$boxSetupString) {
         throw new \Exception('Something went wrong wen parsing the boxSetup');
     }

     foreach ($boxSetup as $stackInstruction) {
         foreach ($stackInstruction as $stackIndex => $box) {
             if (empty($box)) {
                 continue;
             }
             $stack = null;
             if (!array_key_exists($stackIndex + 1, $this->crateStacks)) {
                 $stack = new CrateStack();
                 $this->crateStacks[$stackIndex + 1] = $stack;
             } else {
                 $stack = $this->crateStacks[$stackIndex + 1];
             }
             $stack->addCrates([$box], true);
         }
     }

     ksort($this->crateStacks);
 }

    /**
     * Parse Instructions and execute them.
     *
     * @param array<int, array<int, string>> $instructions
     *
     * @throws \Exception
     */
    public function parseInstructions(array $instructions, bool $moveIndividually = false): void
    {
        if (!$instructions) {
            throw new \Exception('Something went wrong wen parsing the craneInstructions');
        }

        $instructionPattern = '/move (\d+?) from (\d+?) to (\d+?)/';
        foreach ($instructions as $instruction) {
            $instruction = reset($instruction);
            if (!$instruction) {
                throw new \Exception('Something went wrong parsing the instruction');
            }

            $matches = [];
            preg_match_all($instructionPattern, $instruction, $matches);
            if (count($matches) !== 4) {
                throw new \Exception('Something went wrong decoding the instruction');
            }
            $amount = (int) $matches[1][0];
            $fromStack = (int) $matches[2][0];
            $toStack = (int) $matches[3][0];

            if ($moveIndividually) {
                for ($i = 0; $i < $amount; ++$i) {
                    $this->moveCrateStack($toStack, $fromStack, 1);
                }
            } else {
                $this->moveCrateStack($toStack, $fromStack, $amount);
            }
        }
    }

    /**
     * @throws CrateStackEmptyException
     */
    public function getSolution(): string
    {
        $answer = '';
        foreach ($this->crateStacks as $crateStack) {
            $answer .= $crateStack->getTopCrateLetter();
        }

        return $answer;
    }
}
