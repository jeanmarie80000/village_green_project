<?php

namespace App\Controller;

use App\Repository\SousrubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SousrubriqueController extends AbstractController
{
    #[Route('/rubrique/sousrubrique', name: 'app_sousrubrique')]
    public function index(SousrubriqueRepository $repo): Response
    {
        $sr = $repo->findAll();

        return $this->render('rubrique/srindex.html.twig', [
            'sr' => $sr,
        ]);
    }
}
