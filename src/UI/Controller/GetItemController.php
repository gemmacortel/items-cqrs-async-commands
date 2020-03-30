<?php

namespace App\UI\Controller;

use App\Application\GetItem\GetItemQuery;
use App\UI\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetItemController extends AbstractController
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * GetItemController constructor.
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @Route("/{id}", name="get", requirements={"id" = "\d+"}, methods={"GET"})
     * @param int $id
     * @return Response
     * @throws \Exception
     */
    public function find(int $id)
    {
        $itemData = $this->queryBus->dispatch(new GetItemQuery($id));

        return $this->json($itemData);
    }
}
