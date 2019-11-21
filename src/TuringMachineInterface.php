<?php

namespace Vria\TuringMachine;

/**
 * Interface for Turing machines.
 *
 * @author Vlad Riabchenko <contact@vria.eu>
 */
interface TuringMachineInterface
{
    const STATE_STOP = 'Stop';
    const LEFT = 'L';
    const RIGHT = 'R';

    /**
     * @param array $rules
     *     {State}|{Symbol} => {State}|{Write}|{Action}
     *     GoingToEnd|0     => GoingToEnd||R
     *     Changing1ToA|1   => Changing1ToA|A|R
     *     FindingFirst0|0  => Transfer1||L
     * @param array $tape
     *     Initial tape for the Turing machine. Each element in array corresponds to a cell on a tape.
     *     Indexes must start with 0 and continue with a step of 1: [0 => 'x', 1 => 'y', 2 => 'z', ...]
     * @param string $state
     *     Initial state of a machine
     * @param int $headPosition
     *     Initial head position. Should be 0 for the majority of cases.
     *
     * @return TuringMachineInterface
     */
    public static function create(array $rules, array $tape, string $state, int $headPosition = 0): TuringMachineInterface;

    /**
     * Get the tape at the current moment.
     *
     * @return array
     */
    public function getTape(): array;

    /**
     * Get the head position at the current moment.
     *
     * @return int
     */
    public function getHeadPosition(): int;

    /**
     * Get the symbol that the head observes at the current moment.
     *
     * @return string
     */
    public function getCurrentSymbol(): string;

    /**
     * Get the current state.
     *
     * @return string
     */
    public function getState(): string;

    /**
     * Perform the next step:
     * - machine should find a rule according to its current state and a current observable symbol,
     * - machine should apply this rule:
     *     - write observable symbol of necessary,
     *     - change its state if necessary,
     *     - move to left or right.
     *
     * @return void
     */
    public function next(): void;
}
