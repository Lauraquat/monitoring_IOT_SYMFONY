<?php

namespace App\Controller;

use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type", name="type_")
 */
class TypeController extends AbstractController
{
    /**
     * @Route("/", name="browse")
     */
    public function browse(TypeRepository $typeRepository)
    {
        return $this->render('type/browse.html.twig', [
            'types' => $typeRepository->findAll(),
        ]);
    }
}