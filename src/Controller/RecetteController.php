<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette")
     */
    public function index(RecetteRepository $recetteRepository): Response
    {
        return $this->render('recette/recette.html.twig');
    }

    /**
     * @Route("/recette_list", name="recette_list")
     */

    public function recetteList(RecetteRepository $recetteRepository): Response
    {       
        return $this->render('recette/recette_list.html.twig', [
            'recette_list' => $recetteRepository->findAll(),
            
        ]);

    }

    /**
     * @Route("/recette_search", name="recette_search")
     */

     public function recetteSearch()
     {
     
     }




}
