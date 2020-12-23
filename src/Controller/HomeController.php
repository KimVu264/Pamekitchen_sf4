<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Ustensile;
use App\Form\RecetteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/home.html.twig');
        
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
