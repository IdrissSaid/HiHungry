<?php

namespace App\Controller;

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
        $menu = $restaurant[0]->getMenu();
        $plats = $menu[0]->getPlats();

        return $this->render('restaurants/show.html.twig', [
            'restaurant' => $restaurant[0],
            'menus' => $menu,
            'plats' => $plats
        ]);
    }
}
