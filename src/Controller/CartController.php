<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function card(Request $request, Product $product): Response
    {

        $session = $request->getSession();
        $panier = $session->get('panier', []);
        $panier[] = $product;

        if(isset($panier[$product->getId()]))
        {
            $panier[$product->getId()]++;
        } else {
            $panier[$product->getId()] = 1;
        }
        
        $session->set('panier', $panier);

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
        ]);
    }
}
