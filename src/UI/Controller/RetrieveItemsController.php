<?php

namespace App\UI\Controller;

use App\Application\Exception\ItemNotFoundException;
use App\Application\Service\RetrieveItems;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RetrieveItemsController extends AbstractController
{
    private $applicationService;

    public function __construct(RetrieveItems $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/retrieve/{id}/{quantity}", name="retrieve", requirements={"id" = "\d+"}, methods={"PATCH"})
     * @param int $id
     * @param int $quantity
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function retrieve(int $id, int $quantity)
    {
        try {
            $itemData = $this->applicationService->execute($id, $quantity);
        } catch (ItemNotFoundException $e) {
            return $this->json('The item does not exist', Response::HTTP_BAD_REQUEST);
        }

        return $this->json($itemData);
    }
}
