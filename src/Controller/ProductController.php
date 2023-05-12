<?php

namespace App\Controller;

use DateTime;
use DateTimeImmutable;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(ProductRepository $repository): Response
    {

        $products = $repository->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products
        ]);
    }

    /**
     * Function for create a new product
     *
     * @return Response
     */
    #[Route('product/new', name: 'product.new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {

        // Revoir l'entité pour la date ( problème avec DateTimeImmutable )
        // $datetime = new DateTimeImmutable('now');
        // $datetime2 = DateTime::createFromInterface($datetime);

        $product = new Product();
        $product->setName('')
                ->setLabel('')
                ->setDescri('')
                // ->setDateCreate($datetime2)
                ->setPricePt('');
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $manager->persist($product);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre produit a été créé.'
            );

            return $this->redirectToRoute('app_product');
        } else {
            return $this->renderForm('product/new.html.twig', [
                'form' => $form
            ]);
        }

    }

    #[Route('product/edit/{id}', name: 'product.edit', methods:['GET', 'POST'])]
    public function edit(ProductRepository $repository, int $id): Response
    {
        $product = $repository->findOneBy(['id' => $id]);
        $form = $this->createForm(ProductType::class, $product);

        return $this->renderForm('product/edit.html.twig', [
            'form' => $form
        ]);
    }
}
