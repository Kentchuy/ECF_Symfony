<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategorieRepository;

class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(CategorieRepository $categoriesRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'categories' => $categoriesRepository->findBy([], 
            ['categoryOrder' => 'asc']),
            'controller_name' => 'MainController'
        ]);
    }
}
