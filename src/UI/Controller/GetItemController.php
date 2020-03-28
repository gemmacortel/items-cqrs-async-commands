<?php

namespace App\UI\Controller;

use App\Application\Service\GetItemApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetItemController extends AbstractController
{
    /**
     * @var GetItemApplicationService
     */
    private $applicationService;

    public function __construct(GetItemApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/{id}", name="id", requirements={"id" = "\d+"})
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function find(int $id)
    {
        try {
            $itemData = $this->applicationService->execute($id);
        } catch (\Exception $e) {
            return $this->json('The item does not exist', Response::HTTP_BAD_REQUEST);
        }

        return $this->json($itemData);
    }
}
