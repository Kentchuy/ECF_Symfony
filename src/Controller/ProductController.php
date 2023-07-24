<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Entity\Product;

#[Route('/produits', name: 'product_')]
class ProductController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'Produits',
        ]);
    }
    
    #[Route('/{id}', name: 'detail')]
    #[ParamConverter('product', class: 'App\Entity\Product')]
    public function detail(Product $product): Response
    {
    // dump & die ($product)
    // dd($product);
    return $this->render('product/detail.html.twig', compact('product'));
    }
}
