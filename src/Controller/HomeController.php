<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Doctrine\ORM\Query\Expr\GroupBy;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request,RecetteRepository $recetteRepository): Response
    {
        $cate=$request->query->get('category');
        $data=$recetteRepository->category($cate); 
        //dd($data);
        return $this->render('home/home.html.twig', ['categories' => $data]);      
        
    }

     /**
     * @Route("/contact", name="contact")
     */
    public function contactPage(): Response
    {
        return $this->render('home/contact.html.twig');
    }

     /**
     * @Route("/mentions", name="mentions")
     */
    public function mentionsPage(): Response
    {
        return $this->render('home/mentions.html.twig');
    }

    

}
