<?php

namespace App\UI\CLICommand;

use App\Application\DeleteItem\DeleteItemCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class DeleteItemCLICommand extends Command
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    protected static $defaultName = 'delete-item';

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
            ->setDescription('Delete an item')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'Item id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $itemId = $input->getOption('id');

        $this->commandBus->dispatch(new DeleteItemCommand($itemId));

        $io->success('');

        return 0;
    }
}
