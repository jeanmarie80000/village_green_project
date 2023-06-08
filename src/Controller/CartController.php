<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\RubriqueRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{

    #[Route('/cart', name: 'app_cart', methods: ['GET'])]
    public function card(SessionInterface $session, ProductRepository $productRepo): Response
    {

        $cart = $session->get('cart', []);

        $dataCart = [];
        $totalPro = 0;
        $totalCom = 0;

        foreach($cart as $id => $quantity)
        {
            $dataCart[] = [
                'product' => $productRepo->find($id),
                'quantity' => $quantity
            ];

            $totalPro = array_sum($cart);
            $totalCom = $totalCom + $productRepo->find($id)->getPricePt();

        }



        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'items' => $dataCart, 
            'totalPro' => $totalPro,
            'totalCom' => $totalCom
        ]);
    }
    
    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add(SessionInterface $session, RubriqueRepository $repo, $id)
    {

        $cart = $session->get('cart', []);

        if(!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }

        $session->set('cart', $cart);

        $rubrique = $repo->findAll();

        return $this->render('rubrique/index.html.twig', [
            'rubrique' => $rubrique,
        ]);
    }


}
