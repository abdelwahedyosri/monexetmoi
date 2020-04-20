<?php

namespace App\Controller;

use App\Entity\ListeDesPays;
use App\Form\ListeDesPaysType;
use App\Repository\ListeDesPaysRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin_dashboard")
 */
class ListeDesPaysController extends AbstractController
{
    

    /**
     * @Route("/new", name="liste_des_pays_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $listeDesPay = new ListeDesPays();
        $form = $this->createForm(ListeDesPaysType::class, $listeDesPay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($listeDesPay);
            $entityManager->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('liste_des_pays/new.html.twig', [
            'liste_des_pay' => $listeDesPay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="liste_des_pays_show", methods={"GET"})
     */
    public function show(ListeDesPays $listeDesPay): Response
    {
        return $this->render('liste_des_pays/show.html.twig', [
            'liste_des_pay' => $listeDesPay,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="liste_des_pays_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ListeDesPays $listeDesPay): Response
    {
        $form = $this->createForm(ListeDesPaysType::class, $listeDesPay);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            
            return $this->redirectToRoute('main');
        }

        return $this->render('liste_des_pays/edit.html.twig', [
            'liste_des_pay' => $listeDesPay,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="liste_des_pays_delete")
     */
    public function delete(Request $request, ListeDesPays $listeDesPay): Response
    {
       
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($listeDesPay);
            $entityManager->flush();
        

        return $this->redirectToRoute('main');
    }
}
