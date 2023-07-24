<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Categorie;

#[Route('/categories', name: 'categorie_')]

class CategorieController extends AbstractController
{
    
    #[Route('/{id}', name: 'list')]
    #[ParamConverter('categorie', class: 'App\Entity\Categorie')]

    public function list(Categorie $category): Response
    {
        // On va chercher la liste des produits de la catégorie
        $products= $category->getProducts();
        return $this->render('categorie/list.html.twig',compact('category','products'));
        // Autre syntaxe
            // return $this->render('categorie/list.html.twig', [
            //     'category' => $category,
            //     'products' => $products
            // ]);
    }
}
