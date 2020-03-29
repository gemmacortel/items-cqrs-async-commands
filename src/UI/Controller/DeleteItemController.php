<?php

namespace App\UI\Controller;

use App\Application\DeleteItem\DeleteItemCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class DeleteItemController extends AbstractController
{
    /**
     * @var MessageBusInterface
     */
    private $commandBus;

    /**
     * DeleteItemController constructor.
     * @param MessageBusInterface $commandBus
     */
    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Route("/{id}", name="delete", requirements={"id" = "\d+"}, methods={"DELETE"})
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function delete(int $id)
    {
        $command = new DeleteItemCommand($id);

        $this->commandBus->dispatch($command);

        return $this->json('OK', Response::HTTP_ACCEPTED);
    }
}
