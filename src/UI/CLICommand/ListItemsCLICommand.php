<?php

namespace App\UI\CLICommand;

use App\Application\ListItems\ListItemsQuery;
use App\UI\Bus\QueryBus;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ListItemsCLICommand extends Command
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    protected static $defaultName = 'list-items';

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
        $this->setDescription('List all the existing items');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $itemsData = $this->queryBus->dispatch(new ListItemsQuery());

        foreach ($itemsData as $itemData) {
            $io->comment($itemData->getId() . '. ' . $itemData->getName() . ' - Quantity: ' . $itemData->getQuantity());
        }

        $io->success('That\'s all the items.');

        return 0;
    }
}
