<?php

namespace App\UI\Controller;

use App\Application\Service\ListItems;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListItemsController extends AbstractController
{
    /**
     * @var ListItems
     */
    private $applicationService;

    public function __construct(ListItems $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/all", name="list", methods={"GET"})
     * @return Response
     * @throws \Exception
     */
    public function list()
    {
        $itemData = $this->applicationService->execute();

        return $this->json($itemData);
    }
}
