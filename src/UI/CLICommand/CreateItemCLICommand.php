<?php

namespace App\UI\CLICommand;

use App\Application\CreateItem\CreateItemCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class CreateItemCLICommand extends Command
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    protected static $defaultName = 'create-item';

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
            ->setDescription('Create a new item')
            ->addOption('name', null, InputOption::VALUE_REQUIRED, 'Item id')
            ->addOption('quantity', null, InputOption::VALUE_REQUIRED, 'Item quantity to add')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $itemName = $input->getOption('name');
        $itemQuantity = $input->getOption('quantity');

        $this->commandBus->dispatch(new CreateItemCommand($itemName, $itemQuantity));

        $io->success('');

        return 0;
    }
}
