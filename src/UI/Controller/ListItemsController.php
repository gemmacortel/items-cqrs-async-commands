<?php

namespace App\UI\Controller;

use App\Application\ListItems\ListItemsQuery;
use App\UI\Bus\QueryBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListItemsController extends AbstractController
{
    /**
     * @var QueryBus
     */
    private $queryBus;

    /**
     * ListItemsController constructor.
     * @param QueryBus $queryBus
     */
    public function __construct(QueryBus $queryBus)
    {
        $this->queryBus = $queryBus;
    }

    /**
     * @Route("/all", name="list", methods={"GET"})
     * @return Response
     * @throws \Exception
     */
    public function list()
    {
        $items = $this->queryBus->dispatch(new ListItemsQuery());

        return $this->json($items);
    }
}
