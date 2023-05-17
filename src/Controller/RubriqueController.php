<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RubriqueController extends AbstractController
{
    #[Route('/rubrique', name: 'app_rubrique')]
    public function index(RubriqueRepository $repo): Response
    {

        $rubrique = $repo->findAll();

        return $this->render('rubrique/index.html.twig', [
            'rubrique' => $rubrique,
        ]);
    }
}
