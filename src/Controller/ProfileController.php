<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Avec cette route on va accéder à toutes les méthodes du controller
#[Route('/profil', name: 'profile_')]

class ProfileController extends AbstractController
{
    #[Route('/', name: 'index')]
    // La route URL http://127.0.0.1:8000/profil ira par défaut ici en ajoutant le dernier /
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Profil de l\'utilisateur',
        ]);
    }

    #[Route('/commandes', name: 'orders')]
    // La route URL pour les commandes sera http://127.0.0.1:8000/profil/commandes
    public function orders(): Response
    {
        return $this->render('profile/index.html.twig', [
        'controller_name' => 'Commandes de l\'utilisateur',
        ]);
    }
}