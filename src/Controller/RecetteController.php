<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecetteController extends AbstractController
{
    /**
     * @Route("/recette", name="recette")
     */
    public function index(RecetteRepository $recetteRepository): Response
    {
        
        $resultat=$recetteRepository->findBy([], ['id'=> 'DESC'],6,0 );
        
        $resultats=$recetteRepository->findBy([], ['tps_total'=> 'ASC'],5,0 );      

        return $this->render('recette/recette.html.twig', [
            'recettes'=> $resultat,
            'results'=> $resultats, 
    
        ]);
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
     * @Route("/recette_cat/{id}", name="recette_cat",  methods={"GET","HEAD"})
     * 
     */

    public function recetteCat(int $id, RecetteRepository $recetteRepository): Response
    { 
    
    
        // return $this->render('recette/recette_cat.html.twig',[
        //  'cat_recette' => $recetteRepository->findBy([], ['category'=> $id]),
           
        //  ]);

    }

    /**
     * @Route("/recette/{id<\d+>}", name="recette_page")
     * Le FrameworkExtraBundle a installée le ParamConverter qui permet de convertir des paramètres de route en autre chose 
     * Il est capable de convertir des paramètres en entités sans aucune configuration supplémentaire
     */


    public function recettePage(Recette $recette): Response
    {
        return $this->render('recette/recette_page.html.twig', [
            'recette' => $recette
        ]);
    }


}
