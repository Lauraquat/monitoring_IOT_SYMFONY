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
 * @Route("/module")
 */
class ModuleController extends AbstractController
{
    /**
     * @Route("/", name="module_browse", methods={"GET"})
     */
    public function browse(ModuleRepository $moduleRepository): Response
    {
        return $this->render('module/browse.html.twig', [
            'modules' => $moduleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="module_read", methods={"GET"}, requirements={"id": "\d+"})
     */
    public function read(Module $module): Response
    {
        return $this->render('module/read.html.twig', [
            'module' => $module,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="module_edit", methods={"GET","POST"}, requirements={"id": "\d+"})
     */
    public function edit(Request $request, Module $module): Response
    {
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('module_browse');
        }

        return $this->render('module/edit.html.twig', [
            'module' => $module,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/add", name="module_add", methods={"GET","POST"})
     */
    public function add(Request $request): Response
    {
        $module = new Module();
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($module);
            $entityManager->flush();

            return $this->redirectToRoute('module_browse');
        }

        return $this->render('module/add.html.twig', [
            'module' => $module,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/delete", name="module_delete", methods={"DELETE"}, requirements={"id": "\d+"})
     */
    public function delete(Request $request, Module $module): Response
    {
        if ($this->isCsrfTokenValid('delete' . $module->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($module);
            $entityManager->flush();
        }

        return $this->redirectToRoute('module_browse');
    }
}
