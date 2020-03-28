<?php

namespace App\UI\Controller;

use App\Application\Service\ListItemsApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListItemsController extends AbstractController
{
    /**
     * @var ListItemsApplicationService
     */
    private $applicationService;

    public function __construct(ListItemsApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/all")
     * @return Response
     * @throws \Exception
     */
    public function list()
    {
        $itemData = $this->applicationService->execute();

        return $this->json($itemData);
    }
}
