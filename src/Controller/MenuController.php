<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Restaurant;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu/new/{id}', name: 'menu_new')]
    public function new(int $id, ManagerRegistry $doctrine): Response
    {
        $em = $doctrine->getManager();
        $restaurant = $em->getRepository(Restaurant::class)->findById($id)[0];
        $menu = new Menu();
        $menu->setName($restaurant->getName());
        $menu->setRestaurant($restaurant);
        $restaurant->addMenu($menu);
        $em->persist($menu);
        $em->persist($restaurant);
        $em->flush();
        return $this->redirectToRoute('app_home');
    }
}
