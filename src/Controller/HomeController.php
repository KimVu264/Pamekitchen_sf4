<?php

namespace App\Controller;

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
     * @Route("/test", name="test")
     */
   
    public function recetteAdd(Request $request, EntityManagerInterface $manager)
    {
           //1. Créer le formulaire
           $form=$this->createForm(RecetteFormType::class);

           //2.Passage de la requête au formulaire (récupération des données POST, validation)
           $form->handleRequest($request);

           //3.Vérifier si le formulaire a été envoyé et est valide
           if($form->isSubmitted()&& $form->isValid()){

              //4.Récupérer les data du formulaire
              $recette=$form->getData();
              $form->get('video_file')->getData();
              

              //enregistrement en BDD
              $manager->persist($recette);
              $manager->flush();

            
              return $this->redirectToRoute('home',['id'=>$recette->getId()]);
           }

          //on envoit une vue de formulaire au template
           return $this->render('admin/dashboard/index.html.twig',[
               'recette_form'=>$form->createView()

           ]);

    }
}
