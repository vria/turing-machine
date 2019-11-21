<?php

namespace Vria\TuringMachine;

/**
 * Implementation of the Turing Machine.
 *
 * TODO: Implement all methods
 */
class TuringMachine implements TuringMachineInterface
{
    public static function create(array $rules, array $tape, string $state, int $headPosition = 0): TuringMachineInterface
    {
        // TODO: Implement create() method.
    }

    public function getTape(): array
    {
        // TODO: Implement getTape() method.
    }

    public function getHeadPosition(): int
    {
        // TODO: Implement getHeadPosition() method.
    }

    public function getCurrentSymbol(): string
    {
        // TODO: Implement getCurrentSymbol() method.
    }

    public function getState(): string
    {
        // TODO: Implement getState() method.
    }

    public function next(): void
    {
        // TODO: Implement next() method.
    }
}
