<?php

namespace App\Controller;

use App\Repository\HistoryRepository;
use App\Repository\ModuleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/history", name="history_")
 */
class HistoryController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(HistoryRepository $historyRepository, ModuleRepository $moduleRepository)
    {
        // Affichage de l'historique de tous les modules
        return $this->render('history/browse.html.twig', [
            'histories' => $historyRepository->findAll(),
            'module' => $moduleRepository->findAll(),
        ]);
    }
}