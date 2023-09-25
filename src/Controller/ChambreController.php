<?php

namespace App\Controller;

use App\Repository\ChambresRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChambreController extends AbstractController
{
    /**
     * @Route("/chambre", name="app_chambre")
     */
    public function index(ChambresRepository $chambreRepository): Response
    {
        $chambre = $chambreRepository->findAll(); 

        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
            'chambres' => $chambre,
        ]);
    }
}
