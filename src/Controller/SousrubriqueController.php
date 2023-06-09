<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Rubrique;
use App\Entity\Sousrubrique;
use App\Repository\RubriqueRepository;
use App\Repository\SousrubriqueRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SousrubriqueController extends AbstractController
{
    
    /**
     * 
     */
    #[Route('rubrique/{id}', name: 'app_sousrubriqueId', methods: ['GET'])]
    public function indexSr(Rubrique $rubrique): Response
    {
        
        return $this->render('rubrique/srindex.html.twig', [
            'sr' => $rubrique,
        ]);
    }
    
    /**
     *
     */
    #[Route('/rubrique/sousrubrique', name: 'app_sousrubrique')]
    public function index(SousrubriqueRepository $repo): Response
    {
        $sr = $repo->findAll();

        return $this->render('rubrique/srindex.html.twig', [
            'sr' => $sr,
        ]);
    }
}
