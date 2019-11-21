<?php

namespace Vria\TuringMachine\Command;

/**
 * Increment a binary number:
 * 1011 => 1100
 * 111 => 1000
 *
 * @author Vlad Riabchenko <contact@vria.eu>
 */
class IncrementBinaryCommand extends RunTuringMachineCommand
{
    protected static $defaultName = 'turing:run:increment-binary';

    /**
     * @inheritDoc
     */
    protected function getRules(): array
    {
        return [
            'ToEnd|0' => 'ToEnd|0|R',
            'ToEnd|1' => 'ToEnd|1|R',
            'ToEnd|' => 'CarryOne||L',
            'CarryOne|1' => 'CarryOne|0|L',
            'CarryOne|0' => 'Stop|1|L',
            'CarryOne|' => 'Stop|1|L',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getTape(): array
    {
        return ['1', '0', '1', '1'];
    }

    /**
     * @inheritDoc
     */
    protected function getInitialState(): string
    {
        return 'ToEnd';
    }
}
