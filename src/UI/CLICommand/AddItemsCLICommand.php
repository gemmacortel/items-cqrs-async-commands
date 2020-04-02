<?php

namespace App\UI\CLICommand;

use App\UI\Bus\AsyncCommandBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddItemsCLICommand extends Command
{
    /**
     * @var AsyncCommandBus
     */
    private $asyncCommandBus;

    protected static $defaultName = 'add-items';

    /**
     * AddItemsController constructor.
     * @param AsyncCommandBus $asyncCommandBus
     */
    public function __construct(AsyncCommandBus $asyncCommandBus)
    {
        parent::__construct();

        $this->asyncCommandBus = $asyncCommandBus;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add stock to an item')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'Item id')
            ->addOption('quantity', null, InputOption::VALUE_REQUIRED, 'Item quantity to add')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $itemId = $input->getOption('id');
        $itemQuantity = $input->getOption('quantity');

        $message = ["id" => $itemId, "quantity" => $itemQuantity];

        $this->asyncCommandBus->dispatch($message);

        $io->success('');

        return 0;
    }
}
