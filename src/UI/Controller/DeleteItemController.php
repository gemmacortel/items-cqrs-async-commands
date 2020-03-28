<?php

namespace App\UI\Controller;

use App\Application\Service\DeleteItemApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteItemController extends AbstractController
{
    /**
     * @var DeleteItemApplicationService
     */
    private $applicationService;

    public function __construct(DeleteItemApplicationService $applicationService)
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
        } catch (\Exception $e) {
            return $this->json('The item does not exist', Response::HTTP_BAD_REQUEST);
        }

        return $this->json('The item has been correctly removed', Response::HTTP_OK);
    }
}
