<?php

namespace App\UI\Controller;

use App\Application\SubstractItems\SubstractItemsCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class SubstractItemsController extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    private $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("/retrieve/{id}/{quantity}", name="retrieve", requirements={"id" = "\d+"}, methods={"PATCH"})
     * @param int $id
     * @param int $quantity
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function retrieve(int $id, int $quantity)
    {
        $command = new SubstractItemsCommand($id, $quantity);

        $this->messageBus->dispatch($command);

        return $this->json('OK', Response::HTTP_ACCEPTED);
    }
}
