<?php

namespace App\Controller;

use App\Entity\Panier;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine){}

    #[Route('/panier/confirm/{id}', name: 'confirm_panier', methods: ['GET', 'POST'])]
    public function confirm(Request $request, int $id): Response
    {
        $em = $this->doctrine->getManager();
        $panier = $em->getRepository(Panier::class)->findById($id)[0];
        if (!$panier)
            return $this->redirectToRoute($request->headers->get('referer'), [], 500);
        $panier->setConfirm(true);
        $em->persist($panier);
        $em->flush();
        return $this->redirect($request->headers->get('referer'));
    }
}
