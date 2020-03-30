<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/module", name="module_")
 */
class ModuleController extends AbstractController
{
    /**
     * @Route("/", name="browse", methods={"GET"})
     */
    public function browse(ModuleRepository $moduleRepository): Response
    {
        // Affichage de tous les modules avec leurs propriétés
        return $this->render('module/browse.html.twig', [
            'modules' => $moduleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Module $module): Response
    {
        // Affichage d'un module et de ses propriétés
        return $this->render('module/read.html.twig', [
            'module' => $module,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET","POST"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, Module $module): Response
    {
        // Création du formulaire en récupérant les propriétés de l'entité Module
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        // si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on envoie les nouvelles données en BDD
            $this->getDoctrine()->getManager()->flush();

            // Puis on redirige vers l'accueil
            return $this->redirectToRoute('home');
        }

        // Affichage du formulaire
        return $this->render('module/edit.html.twig', [
            'module' => $module,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/add", name="add", methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        // Création d'une variable $module qui récupère les propriétés de l'entité Module
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        // Si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // on envoie en BDD les données pour créer le nouvel objet
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($module);
            $entityManager->flush();

            // On redirige vers l'accueil
            return $this->redirectToRoute('home');
        }

        // Affichage du formulaire
        return $this->render('module/add.html.twig', [
            'module' => $module,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/delete", name="delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(Request $request, Module $module): Response
    {
        // Suppression d'un objet module
        if ($this->isCsrfTokenValid('delete' . $module->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($module);
            $entityManager->flush();
        }

        // redirection vers l'accueil
        return $this->redirectToRoute('home');
    }
}
