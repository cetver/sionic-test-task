<?php

namespace App\Controller;

use App\Entity\ItemEntity;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends AbstractController
{
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request)
    {
        $itemRepository = $entityManager->getRepository(ItemEntity::class);
        $pagination = $paginator->paginate(
            $itemRepository->paginationQuery(),
            $request->query->getInt('page', 1),
            25
        );

        return $this->render(
            'default/index.html.twig',
            [
                'controller_name' => 'DefaultController',
                'pagination' => $pagination,
            ]
        );
    }
}
