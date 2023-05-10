<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SousCategorieController extends AbstractController
{
    #[Route('/categorie/sousCat', name: 'app_sous_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/sousCatIndex.html.twig', [
            'controller_name' => 'SousCategorieController',
        ]);
    }
}
