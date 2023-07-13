<?php

namespace App\Controller;

use App\Entity\Rubrique;
use App\Entity\BanquePhoto;
use App\Repository\BanquePhotoRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RubriqueController extends AbstractController
{
    #[Route('/rubrique', name: 'app_rubrique')]
    public function index(
        RubriqueRepository $repository,
        BanquePhotoRepository $PhotoRepo
        ): Response
    {

        $rub = $repository->findAll();

        
        $rubId = array_keys($rub);
        
        // $photo = $rubrique->getPhoto();
        return $this->render('rubrique/index.html.twig', [
            'rubriques' => $rub
        ]);
    }
}
