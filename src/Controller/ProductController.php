<?php

namespace App\Controller;

use App\Entity\BanquePhoto;
use App\Entity\Product;
use App\Form\ProductType;
use App\Entity\Sousrubrique;
use App\Repository\BanquePhotoRepository;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\Criteria;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/{sousrubrique}/product')]
class ProductController extends AbstractController
{
    
    #[Route('/index', name: 'app_product_index', methods: ['GET'])]
    public function index(Sousrubrique $sousrubrique, Product $product, BanquePhotoRepository $photoRepo): Response
    {

        // Afficher "Photo" de photoRepo selon photo.id_product ( 1 ou 2 )

        return $this->render('product/index.html.twig', [
            'products' => $sousrubrique,
            'renderingPhoto' => $photoRepo->findOneBy(['photo' => $product]),
        ]);
    }

    #[Route('/new', name: 'app_product_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ProductRepository $productRepository): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_show', methods: ['GET'])]
    public function show(Sousrubrique $sousrubrique, Product $product, BanquePhoto $photo): Response
    {
        return $this->render('product/show.html.twig', [
            'sr' => $sousrubrique,
            'product' => $product,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $productRepository->save($product, true);

            return $this->redirectToRoute('app_product_index', ["sousrubrique" => $product->getSousrubrique()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_product_delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, ProductRepository $productRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $productRepository->remove($product, true);
        }

        return $this->redirectToRoute('app_product_index', ["sousrubrique" => $product->getSousrubrique()->getId()], Response::HTTP_SEE_OTHER);
    }
}
