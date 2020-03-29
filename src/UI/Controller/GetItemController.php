<?php

namespace App\UI\Controller;

use App\Application\GetItem\GetItemQuery;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Symfony\Component\Routing\Annotation\Route;

class GetItemController extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    private $queryBus;

    /**
     * GetItemController constructor.
     * @param MessageBusInterface $queryBus
     */
    public function __construct(MessageBusInterface $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @Route("/{id}", name="get", requirements={"id" = "\d+"}, methods={"GET"})
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function find(int $id)
    {
        $envelope = $this->queryBus->dispatch(new GetItemQuery($id));

        $handled = $envelope->last(HandledStamp::class);

        return $this->json($handled->getResult());
    }
}
