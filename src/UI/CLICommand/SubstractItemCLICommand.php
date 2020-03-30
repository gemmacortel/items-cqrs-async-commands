<?php

namespace App\UI\CLICommand;

use App\Application\GetItem\GetItemQuery;
use App\Application\SubstractItems\SubstractItemsCommand;
use App\UI\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class SubstractItemCLICommand extends Command
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    protected static $defaultName = 'substract-items';

    /**
     * @param MessageBusInterface $commandBus
     */
    public function __construct(MessageBusInterface $commandBus)
    {
        parent::__construct();

        $this->commandBus = $commandBus;
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

        $this->commandBus->dispatch(new SubstractItemsCommand($itemId, $itemQuantity));

        $io->success('');

        return 0;
    }
}
