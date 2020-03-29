<?php

namespace App\UI\Controller;

use App\Application\Exception\ItemNotFoundException;
use App\Application\Service\DeleteItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteItemController extends AbstractController
{
    /**
     * @var DeleteItem
     */
    private $applicationService;

    public function __construct(DeleteItem $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/{id}", name="delete", requirements={"id" = "\d+"}, methods={"DELETE"})
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function delete(int $id)
    {
        try {
            $this->applicationService->execute($id);
        } catch (ItemNotFoundException $e) {
            return $this->json('The item does not exist', Response::HTTP_BAD_REQUEST);
        }

        return $this->json('The item has been correctly removed', Response::HTTP_OK);
    }
}
