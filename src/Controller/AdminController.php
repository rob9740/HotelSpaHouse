<?php

namespace App\Controller;

use App\Entity\Chambres;
use App\Form\ChambreType;
use App\Repository\ChambresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="app_admin")
     */
    public function index(ChambresRepository $chambreRepository): Response
    {
        $chambre = $chambreRepository->findAll(); 

        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
            'chambres' => $chambre,
        ]);
    }

    
}
