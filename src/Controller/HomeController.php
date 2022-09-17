<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\CardType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, Request $request): Response
    {
        $em = $doctrine->getManager();
        $restaurants = $em->getRepository(Restaurant::class)->findAll();

        return $this->render('home/index.html.twig', [
            'restaurants' => $restaurants
        ]);
    }
}
