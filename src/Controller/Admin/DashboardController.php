<?php

namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Ustensile;
use App\Form\RecetteFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;


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
        return $this->render('admin/dashboard/index.html.twig');
    }

     /**
     * @Route("/recette/add", name="recette_add")
     */
   
    public function recetteAdd(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger)
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
                $brochureFile = $form->get('brochure')->getData();
                if ($brochureFile) {
                  $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                  // this is needed to safely include the file name as part of the URL
                  $safeFilename = $slugger->slug($originalFilename);
                  $newFilename = uniqid(time()).'_'.$safeFilename.'.'.$brochureFile->guessExtension();
  
                  // Move the file to the directory where brochures are stored
                  try {
                      $brochureFile->move(
                          $this->getParameter('uploads_directory'),
                          $newFilename
                      );
                  } catch (FileException $e) {
                      // ... handle exception if something happens during file upload
                  }
  
                  // updates the 'brochureFilename' property to store the PDF file name
                  // instead of its contents
                  $recette->setBrochure($newFilename);
                }
              //enregistrement en BDD
              $manager->persist($recette);
              
              $manager->flush();

                //   //ajout d'un message flash
              $this->addFlash('success','La nouvelle recette a été enregistrée.');
               return $this->render('admin/dashboard/index.html.twig', [
                'recette_form'=>$form->createView()
                ]);

            }
           
            //on envoit une vue de formulaire au template
            return $this->render('admin/dashboard/recette_add.html.twig',[
                'recette_form'=>$form->createView()
                ]);
        
    }


    
    
}
