<?php

namespace App\UI\Controller;

use App\UI\Bus\AsyncCommandBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubstractItemsController extends AbstractController
{
    /**
     * @var AsyncCommandBus
     */
    private $asyncCommandBus;

    /**
     * AddItemsController constructor.
     * @param AsyncCommandBus $asyncCommandBus
     */
    public function __construct(AsyncCommandBus $asyncCommandBus)
    {
        $this->asyncCommandBus = $asyncCommandBus;
    }

    /**
     * @Route("/retrieve/{id}/{quantity}", name="retrieve", requirements={"id" = "\d+"}, methods={"PATCH"})
     * @param int $id
     * @param int $quantity
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function retrieve(int $id, int $quantity)
    {
        $message = ["id" => $id, "quantity" => $quantity];

        $this->asyncCommandBus->dispatch($message);

        return $this->json('OK', Response::HTTP_ACCEPTED);
    }
}
