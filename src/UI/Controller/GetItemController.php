<?php

namespace App\UI\Controller;

use App\Application\Exception\ItemNotFoundException;
use App\Application\Service\GetItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetItemController extends AbstractController
{
    /**
     * @var GetItem
     */
    private $applicationService;

    public function __construct(GetItem $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/{id}", name="get", requirements={"id" = "\d+"}, methods={"GET"})
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function find(int $id)
    {
        try {
            $itemData = $this->applicationService->execute($id);
        } catch (ItemNotFoundException $e) {
            return $this->json('The item does not exist', Response::HTTP_BAD_REQUEST);
        }

        return $this->json($itemData);
    }
}
