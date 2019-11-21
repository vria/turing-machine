<?php

namespace Vria\TuringMachine\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Vria\TuringMachine\TuringMachineInterface;

/**
 * Abstract command for running and visualizing the Turing machine.
 *
 * @author Vlad Riabchenko <contact@vria.eu>
 */
abstract class RunTuringMachineCommand extends Command
{
    const WIDTH = 10;

    /**
     * @var string
     */
    private $turingMachineClass;

    /**
     * Constructor.
     *
     * @param string $turingMachineClass
     */
    public function __construct(string $turingMachineClass)
    {
        parent::__construct();

        if (!in_array(TuringMachineInterface::class, class_implements($turingMachineClass))) {
            throw new \InvalidArgumentException(sprintf('Turing machine class must implement %s', TuringMachineInterface::class));
        }

        $this->turingMachineClass = $turingMachineClass;
    }


    /**
     * @inheritDoc
     */
    protected function configure()
    {
        $this->setDescription('Run the Turing machine');
    }

    /**
     * @inheritDoc
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $machine TuringMachineInterface */
        $machine = ($this->turingMachineClass)::create($this->getRules(), $this->getTape(), $this->getInitialState());

        $io = new SymfonyStyle($input, $output);
        $step = 0;

        $this->showTape($io, $machine, $step);

        do {
            $step++;
            $machine->next();
            $this->showTape($io, $machine, $step);
        } while ($machine->getState() != TuringMachineInterface::STATE_STOP);
    }

    /**
     * @inheritDoc
     */
    private function showTape(SymfonyStyle $io, TuringMachineInterface $machine, int $step): void
    {
        $state = $machine->getState();
        $io->writeln(sprintf('<info>Step: %d, State: %s</info>', $step, $state));

        // Enlarge the tape on both sides with empty cells.
        $pad = array_fill(0, self::WIDTH, '');
        $tape = array_merge($pad, $machine->getTape(), $pad);

        // Select the segment of tape which center is a current head position.
        $showTape = array_slice($tape, $machine->getHeadPosition(), self::WIDTH * 2 + 1);

        $io->table(
            array_merge(
                array_fill(0, self::WIDTH, ' '),
                ["<error>v</error>"],
                array_fill(0, self::WIDTH, ' ')
            ),
            [$showTape]
        );
    }

    /**
     * Get rules.
     * @see TuringMachineInterface::create()
     *
     * @return array
     */
    abstract protected function getRules(): array;

    /**
     * Get an initial tape.
     * @see TuringMachineInterface::create()
     *
     * @return array
     */
    abstract protected function getTape(): array;

    /**
     * Get an initial state.
     * @see TuringMachineInterface::create()
     *
     * @return string
     */
    abstract protected function getInitialState(): string;
}
