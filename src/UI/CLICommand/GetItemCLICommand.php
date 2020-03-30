<?php

namespace App\UI\CLICommand;

use App\Application\GetItem\GetItemQuery;
use App\UI\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class GetItemCLICommand extends Command
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    protected static $defaultName = 'get-item';

    /**
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus)
    {
        parent::__construct();

        $this->queryBus = $queryBus;
    }

    protected function configure()
    {
        $this
            ->setDescription('Get item data')
            ->addOption('id', null, InputOption::VALUE_REQUIRED, 'Item id')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $itemId = $input->getOption('id');

        $itemData = $this->queryBus->dispatch(new GetItemQuery($itemId));


        $io->comment($itemData->getId() . '. ' . $itemData->getName() . ' - Quantity: ' . $itemData->getQuantity());

        $io->success('');

        return 0;
    }
}
