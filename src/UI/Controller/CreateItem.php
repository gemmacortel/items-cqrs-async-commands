<?php

namespace App\UI\Controller;

use App\Application\Service\CreateItemApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateItem extends AbstractController
{
    /**
     * @var CreateItemApplicationService
     */
    private $applicationService;

    public function __construct(CreateItemApplicationService $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/", requirements={"id" = "\d+"}, methods={"POST"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function retrieve(Request $request)
    {
        $content = json_decode($request->getContent());

        $name = $content->name;
        $quantity = $content->quantity;

        $itemData = $this->applicationService->execute($name, $quantity);

        return $this->json($itemData);
    }
}
