<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search", methods={"GET", "POST"})
     */

    public function index(Request $request, RecetteRepository $recetteRepository): Response
    {
 
        $keyword= $request->get('search');
        $data=$recetteRepository->search($keyword); 
        // dd($data);
        return $this->render('search/searchResults.html.twig', ['results' => $data]);
    
    }

}