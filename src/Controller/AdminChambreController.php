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

class AdminChambreController extends AbstractController
{
    /**
     * @Route("/admin/chambre", name="app_admin_chambre")
     */
    public function index(ChambresRepository $chambreRepository): Response
    {
        $chambre = $chambreRepository->findAll(); 

        return $this->render('admin_chambre/adminChambres.html.twig', [
            'controller_name' => 'AdminChambreController',
            'chambres' => $chambre,
        ]);
    }

    /**
     * @Route("/admin/create", name="app_create")
     */
    public function create(Request $request, EntityManagerInterface $manager)
    {
        $chambre = new Chambres();

        $form = $this->createForm(ChambreType::class, $chambre);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($chambre);
            $manager->flush();

            return $this->redirectToRoute('app_admin_chambre');
        }

        return $this->render('admin_Chambre/adminChambresForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/update-{id}", name="app_update")
     */
    public function update(ChambresRepository $chambreRepository, $id, Request $request, EntityManagerInterface $manager)
    {
        $chambres = $chambreRepository->find($id);

        $form = $this->createForm(ChambreType::class, $chambres);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($chambres);
            $manager->flush();

            $this->addFlash(
                'warning',
                'Album a bien été modifié'
            );

            return $this->redirectToRoute('app_admin_chambre');
        }

        return $this->render('admin_Chambre/adminChambresForm.html.twig', [
            'form' => $form->createView()
        ]);


        
    }

    /**
     * @Route("/admin/delete-{id}", name="app_delete")
     */
    public function delete(ChambresRepository $chambreRepository, $id, EntityManagerInterface $manager)
    {
        $chambre = $chambreRepository->find($id);

        $manager->remove($chambre);
        $manager->flush();

        return $this->redirectToRoute('app_admin_chambre');

    }

    


}
