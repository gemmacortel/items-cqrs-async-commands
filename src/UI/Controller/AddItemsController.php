<?php

namespace App\UI\Controller;

use App\Application\AddItems\AddItemsCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class AddItemsController extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/add/{id}/{quantity}", name="add", requirements={"id" = "\d+"}, methods={"PATCH"})
     * @param int $id
     * @param int $quantity
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function add(int $id, int $quantity)
    {
        $command = new AddItemsCommand($id, $quantity);

        $this->commandBus->dispatch($command);

        return $this->json('OK', Response::HTTP_ACCEPTED);
    }
}
