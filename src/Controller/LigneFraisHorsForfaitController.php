<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LigneFraisHorsForfaitController extends AbstractController
{
    /**
     * @Route("/ligne/frais/hors/forfait", name="ligne_frais_hors_forfait")
     */
    public function index()
    {
        return $this->render('ligne_frais_hors_forfait/index.html.twig', [
            'controller_name' => 'LigneFraisHorsForfaitController',
        ]);
    }
}
