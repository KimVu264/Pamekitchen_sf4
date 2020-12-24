<?php

namespace App\Controller\Admin;


use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Ustensile;
use App\Form\RecetteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
// use Symfony\Component\String\Slugger\SluggerInterface;
// use Symfony\Component\HttpFoundation\File\Exception\FileException;


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
     */
   
    public function recetteAdd(Request $request, EntityManagerInterface $manager)
    {
           //1. Créer le formulaire
           $form=$this->createForm(RecetteFormType::class,(new Recette()) 
           ->addIngredient(new Ingredient)
           ->addUstensile(new Ustensile)
            );
           
           

           //2.Passage de la requête au formulaire (récupération des données POST, validation)
           $form->handleRequest($request);

           //3.Vérifier si le formulaire a été envoyé et est valide
           if($form->isSubmitted()&& $form->isValid()){

              //4.Récupérer les data du formulaire
              $recette = $form->getData();
            //   $videoFile=$form->get('video_file')->getData();

            //   if($videoFile){
            //       $originalFilename = pathinfo($videoFile->getClientOriginalName(),PATHINFO_FILENAME);
            //       $safeFilename = $slugger->slug($originalFilename);
            //       $newFilename = $safeFilename.'-'.uniqid().'.'.$videoFile->guessExtension();

            //       try {
            //           $videoFile->move(
            //               $this->getParameter('video_directory'),
            //               $newFilename
            //           );
            //       } catch(FileException $e){

            //         }
                    
            //         $videoFile->setVideoFilename($newFilename);
            //   }
              

              //enregistrement en BDD
              $manager->persist($recette);
              $manager->flush();



                //   //ajout d'un message flash
                //   $this->addFlash('success','Le nouvel artiste a été enregistré.');
                // return $this->render('home/contact.html.twig');
                return $this->render('admin/dashboard/index.html.twig',[
                  'recette_form'=>$form->createView()
                  ]);
            }


            //on envoit une vue de formulaire au template
            return $this->render('admin/dashboard/index.html.twig',[
                'recette_form'=>$form->createView()
                ]);
        
    }
    
    
}
