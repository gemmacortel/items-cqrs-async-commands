<?php

namespace App\UI\Controller;

use App\Application\CreateItem\CreateItemCommand;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateItemController extends AbstractController
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
     * @Route("/", name="create", requirements={"id" = "\d+"}, methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function retrieve(Request $request)
    {
        $content = json_decode($request->getContent());

        $command = new CreateItemCommand($content->name, $content->quantity);

        $this->commandBus->dispatch($command);

        return $this->json('OK', Response::HTTP_ACCEPTED);
    }
}
