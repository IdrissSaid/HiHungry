<?php

namespace App\Controller;

use App\Entity\Panier;
use App\Entity\Plats;
use App\Entity\Restaurant;
use App\Form\RestaurantType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantsController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine){}

    #[Route('/restaurants/new', name:'restaurants_new')]
    public function new(Request $request) : Response
    {
        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->doctrine->getManager();
            $em->persist($restaurant);
            $em->flush();
            return $this->redirectToRoute('menu_new', ['id' => $restaurant->getId()]);
        }

        return $this->render('restaurants/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/restaurants/show/{id}', name:'restaurant_show')]
    public function show(int $id) : Response
    {
        $em = $this->doctrine->getManager();
        $restaurant = $em->getRepository(Restaurant::class)->findById($id);
        $panier = $em->getRepository(Panier::class)->findAll()[0];
        $panierP = $panier->getPlats();
        $menu = $restaurant[0]->getMenu();
        $plats = $em->getRepository(Plats::class)->findByMenuId(2);

        return $this->render('restaurants/show.html.twig', [
            'restaurant' => $restaurant[0],
            'menus' => $menu,
            'plats' => $plats,
            'panier' => $panierP
        ]);
    }

    #[Route('/panier/add/{id}', name:'add_plat_panier', methods:['GET', 'POST'])]
    public function addPlatInPanier(Plats $plat, Request $request)
    {
        $em = $this->doctrine->getManager();
        $panier = $em->getRepository(Panier::class)->findAll()[0];
        $plat->setQuantity($plat->getQuantity() + 1);
        $panier->addPlat($plat);
        $em->persist($panier);
        $em->flush();
        $route = $request->headers->get('referer');
        return $this->redirect($route);
    }
}
