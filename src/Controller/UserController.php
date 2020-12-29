<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Ustensile;
use App\Form\InscriptionFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RecetteFormType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{

    // public function register(UserPasswordEncoderInterface $encoder)
    // {
    //     $user = new User();
    //     $plainPassword ='ryanpass';
    //     $encoded =$encoder->encodePassword($user, $plainPassword);
    //     $user->setPassword($encoded);
    // }

    /**
     * @Route("/user", name="user")
     */
    public function new(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder): Response
    {

        //$user = new User();
        //1. Créer le formulaire 
        $form = $this->createForm(InscriptionFormType::class); 

        //2. Passage de la requête au formulaire (récupération des données POST, validation)
        $form->handleRequest($request);

        //3. Vérifier si le formulaire a été envoyé et est validé
        if($form->isSubmitted() && $form->isValid()) {

            //4. Récupérer les données de formulaire
            $user =$form->getData();
            $plainPassword = $form->get('password')->getData();
            $user->setPassword($encoder->encodePassword($user, $plainPassword));
            
        
            //Enregistrement en base de données
            $manager->persist($user);
            $manager->flush(); 

        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user_form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/recette_add", name="recetteadd")
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

              // if($videoFile){
              //     $originalFilename = pathinfo($videoFile->getClientOriginalName(),PATHINFO_FILENAME);
              //     $safeFilename = $slugger->slug($originalFilename);
              //     $newFilename = $safeFilename.'-'.uniqid().'.'.$videoFile->guessExtension();

              //     try {
              //         $videoFile->move(
              //             $this->getParameter('images/recette_directory'),
              //             $newFilename
              //         );
              //     } catch(FileException $e){

              //       }
                    
              //       $videoFile->setVideoFilename($newFilename);
              // }
              

              //enregistrement en BDD
              $manager->persist($recette);
              $manager->flush();



                  //ajout d'un message flash
                  // $this->addFlash('success','la nouvelle recette a été enregistrée.');
                  return $this->render('home/contact.html.twig');
                // return $this->render('admin/dashboard/index.html.twig',[
                //   'recette_form'=>$form->createView()
                //   ]);
            }


            //on envoit une vue de formulaire au template
            return $this->render('user/user_form.html.twig',[
                'recette_form'=>$form->createView()
                ]);
        
    }

    // /**
    //  * recettesUserId
    //  * @Route("/profil", name="profil")
    //  */
    // public function userRecette (UserRepository $userRepository): Response
    // {
    //     // $recettes = $userRepository->findRecetteUser();
    //     return $this->render('user/profil.html.twig'
    //         // 'recettes' => $recettes
    //     );
    // }
}
