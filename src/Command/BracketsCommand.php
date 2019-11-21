<?php

namespace Vria\TuringMachine\Command;

/**
 * Surround a string of "x" with brackets:
 * xxxxx => (xxxxx)
 *
 * @author Vlad Riabchenko <contact@vria.eu>
 */
class BracketsCommand extends RunTuringMachineCommand
{
    protected static $defaultName = 'turing:run:brackets';

    /**
     * @inheritDoc
     */
    protected function getRules(): array
    {
        return [
            'GoingToLeft|x' => 'GoingToLeft|x|L',
            'GoingToLeft|' => 'GoingToRight|(|R',
            'GoingToRight|x' => 'GoingToRight|x|R',
            'GoingToRight|' => 'Stop|)|R',
        ];
    }

    /**
     * @inheritDoc
     */
    protected function getTape(): array
    {
        return ['x', 'x', 'x', 'x'];
    }

    /**
     * @inheritDoc
     */
    protected function getInitialState(): string
    {
        return 'GoingToLeft';
    }
}
