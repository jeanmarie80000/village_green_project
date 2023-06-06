<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{

    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function card(SessionInterface $session, ProductRepository $productRepo): Response
    {

        $cart = $session->get('cart', []);

        $dataCart = [];

        foreach($cart as $id => $quantity)
        {
            $dataCart[] = [
                'product' => $productRepo->find($id),
                'quantity' => $quantity
            ];
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'items' => $dataCart
        ]);
    }
    
    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(SessionInterface $session, $id)
    {

        $cart = $session->get('cart', []);

        if(!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);
        
        dd($session->get('cart'));

    }


}
