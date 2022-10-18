<?php

namespace App\Controller;

use App\Entity\Item;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'cart_index')]
    public function index(SessionInterface $session, ItemRepository $itemRepository): Response
    {
        $panier = $session->get('panier', []);
        $dataPanier = [];
        $total = 0;

        foreach($panier as $id => $quantity) {
            $product = $itemRepository->find($id);
            $dataPanier[] = [
                "product" => $product,
                "quantity" => $quantity
            ];
            $total += $product->getPrice() * $quantity;
        }
        return $this->render('cart/index.html.twig', compact('dataPanier', 'total'));
    }

    #[Route("/add/{id}", name:"cart_add")]
    public function add(Item $product, SessionInterface $session)
    {
        $panier = $session->get('panier');
        $id = $product->getId();

        if (empty($panier[$id])) {
            $panier[$id] = 1;
        } else {
            $panier[$id]++;
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index");
    }

    #[Route("/remove/{id}", name:"cart_remove")]
    public function remove(Item $product, SessionInterface $session)
    {
        $panier = $session->get('panier');
        $id = $product->getId();

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index");
    }

    #[Route("/delete/{id}", name:"cart_delete")]
    public function delete(Item $product, SessionInterface $session)
    {
        $panier = $session->get('panier');
        $id = $product->getId();

        if (!empty($panier[$id]))
            unset($panier[$id]);
        $session->set('panier', $panier);
        return $this->redirectToRoute("cart_index");
    }
}
