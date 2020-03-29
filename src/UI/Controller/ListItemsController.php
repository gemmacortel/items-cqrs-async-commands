<?php

namespace App\UI\Controller;

use App\Application\ListItems\ListItemsQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class ListItemsController extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    private $queryBus;

    /**
     * ListItemsController constructor.
     * @param MessageBusInterface $queryBus
     */
    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @Route("/all", name="list", methods={"GET"})
     * @return Response
     * @throws \Exception
     */
    public function list()
    {
        $envelope = $this->queryBus->dispatch(new ListItemsQuery());

        $handled = $envelope->last(HandledStamp::class);

        return $this->json($handled->getResult());
    }
}
