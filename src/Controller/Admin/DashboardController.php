<?php

namespace App\Controller\Admin;

use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Ustensile;
use App\Form\ConfirmType;
use App\Form\RecetteFormType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/** 
 * Définition de préfixes de routes (préfixes d'URL et de nom):
 * @Route("/admin", name ="admin_")
*/

class DashboardController extends AbstractController
{
   /**
     * URL: /admin
     * nom: admin_dashboard
     * @Route("", name="dashboard")
     */
    
    public function index(): Response
    {
        return $this->render('/admin/dashboard/index.html.twig');
    }

     /**
     * @Route("/dashboard", name="dashboard")
     * 
     */
   
    public function recetteAdd(Request $request, EntityManagerInterface $manager)
    {
           //1. Créer le formulaire
           $form=$this->createForm(RecetteFormType::class,(new Recette()) 
           ->addIngredient(new Ingredient)
           ->addUstensile(new Ustensile)
           ->setUser($this->getUser())
            );
                

           //2.Passage de la requête au formulaire (récupération des données POST, validation)
           $form->handleRequest($request);

           //3.Vérifier si le formulaire a été envoyé et est valide
           if($form->isSubmitted()&& $form->isValid()){

              //4.Récupérer les data du formulaire
              $recette = $form->getData();
              // $videoFile=$form->get('imagefile')->getData();

              //enregistrement en BDD
              $manager->persist($recette);
              $manager->flush();



                  //ajout d'un message flash
                  $this->addFlash('success','la nouvelle recette a été enregistrée.');
                //   return $this->redirectToRoute('home');
                  return $this->render('admin/dashboard/index.html.twig',[
                  'recette_form'=>$form->createView()
                  ]);
                // return $this->redirectToRoute('home');
                
            }


            //on envoit une vue de formulaire au template
            return $this->render('admin/dashboard/index.html.twig',[
                'recette_form'=>$form->createView()
                ]);
        
    }

    /**
     * @Route("/recettes", name="recettes")
     */
    public function recetteList(RecetteRepository $recetteRepository)
     {
        return $this->render('admin/dashboard/recettes.html.twig',[
            'recettes'=> $recetteRepository->findAll(),
            
        ]);
     }

       /**
       * Suppression d'une recette
       * @Route("/recette/{id}/delete", name="recette_delete")
       */
    public function recetteDelete(Recette $recette,EntityManagerInterface $manager,Request $request)
    {
       
        //Création du formulaire
         $form=$this->createForm(ConfirmType::class);
         //pour récupérer les données
         $form->handleRequest($request);

         if($form->isSubmitted()&& $form->isValid())
         {
            //je supprime une recette ds ma bdd
            $manager->remove($recette);
            $manager->flush();

            //message flash
            // $this->addFlash('info',sprintf('la recette"%s" a bien été supprimée.',$recette->getName()));
            return $this->redirectToRoute('admin_recettes');
         }

         return $this->render('admin/dashboard/recette_delete.html.twig',[
             //la donnée sur laquelle on agit
             'recette'=>$recette,
            //on envoit une vue de formulaire au template
            'confirm_form'=>$form->createView(),
            ]);

    }

    /**
       * Modification d'un artiste
       * @Route("/recette/{id}/edit", name="recette_edit")
       */
      public function recetteEdit(Recette $recette, Request $request, EntityManagerInterface $manager)
      {
         //on passe l'entité à modifier au formulaire
         //Il sera pré-rempli, et l'entité sera automatiquement modifiée 
        $form=$this->createForm(RecetteFormType::class,$recette);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //pas d'appel à $form->getData(): l'entité est mise à jour par le formulaire
            //pas d'appel à $manager->persist(): l'entité est déjà connue de l'EntityManager

            $manager->flush();
            $this->addFlash('success', 'La recette a été modifiée.');
            
         return $this->render('admin/dashboard/recette_edit.html.twig',[
            'recette'=>$recette,
            'recette_form'=> $form->createView(),
        ]);

        }

        return $this->render('admin/dashboard/recette_edit.html.twig',[
            'recette'=>$recette,
            'recette_form'=> $form->createView(),
        ]);
      }
    
    
}
