<?php

namespace App\UI\Controller;

use App\Application\Service\CreateItem;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateItemController extends AbstractController
{
    /**
     * @var CreateItem
     */
    private $applicationService;

    public function __construct(CreateItem $applicationService)
    {
        $this->applicationService = $applicationService;
    }

    /**
     * @Route("/", name="create", requirements={"id" = "\d+"}, methods={"POST"})
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
