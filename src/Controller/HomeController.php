<?php

namespace App\Controller;

use App\Entity\Module;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ModuleRepository $moduleRepository)
    {
        // Affichage des modules selon leur activité
        return $this->render('home.html.twig',[
            'actives' => $moduleRepository->findByActive(true),
            'inactives' =>$moduleRepository->findByActive(false),
            'module' => $moduleRepository->findAll(),

        ]);
    }
}