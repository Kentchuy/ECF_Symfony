<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Product;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin/produits', name: 'admin_product_')]

class ProductController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'controller_name' => 'Administration des produits',
        ]);
    }

    #[Route('/ajout', name:'add')]
    public function add(Request $request, EntityManagerInterface $emi): Response 
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN'); 

        //  On crée un nouveau produit :
        $product = new Product;

        // On crée le formulaire
        $productForm = $this->createForm(ProductFormType::class, $product);

        // On traite la requête du formulaire
        $productForm->handleRequest($request);

       // On vérifie si le formulaire est soumis est valide
        if($productForm->isSubmitted() && $productForm->isValid()){

        // On calcule le prix en centime
        $prix = $product->getPrice()*100;
        $product->setPrice($prix);

        // on stocke en BDD
        $emi->persist($product);
        $emi->flush();

        // On redirige
        return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin/product/add.html.twig',[
            'productForm' => $productForm->createView()
        ]);

        // Écriture alternative du return
        // return $this->renderForm('admin/products/add.html.twig', compact('productForm'));
        // compact équivaut à ['productForm' => $productForm]
    }

    #[Route('/edition/{id}', name:'edit')]
    public function edit(Product $product, Request $request, EntityManagerInterface $emi): Response 
    {
        // On vérifie si l'utilisateur peut éditer avec le VOTER
        $this->denyAccessUnlessGranted('PRODUCT_EDIT', $product);

        // On divise le prix par 100
        $prix = $product->getPrice() / 100;
        $product->setPrice($prix);

        // On crée le formulaire
        $productForm = $this->createForm(ProductFormType::class, $product);

        // On traite la requête du formulaire
        $productForm->handleRequest($request);

        // On vérifie si le formulaire est soumis est valide
        if($productForm->isSubmitted() && $productForm->isValid()){

        // On calcule le prix en centime
        $prix = $product->getPrice()*100;
        $product->setPrice($prix);

        // on stocke en BDD
        $emi->persist($product);
        $emi->flush();

        // On redirige
        return $this->redirectToRoute('admin_product_index');
        }

        return $this->render('admin/product/edit.html.twig',[
            'productForm' => $productForm->createView()
        ]);

        // Écriture alternative du return
        // return $this->renderForm('admin/products/edit.html.twig', compact('productForm'));
        // compact équivaut à ['productForm' => $productForm]
    }

    #[Route('/suppression/{id}', name:'delete')]
    public function delete(Product $product): Response 
    {
        // On vérifie si l'utilisateur peut éditer avec le VOTER
        $this->denyAccessUnlessGranted('PRODUCT_DELETE', $product);
        
        return $this->render('admin/product/index.html.twig');
    }
}
