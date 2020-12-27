<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionFormType;
use Doctrine\ORM\EntityManagerInterface;
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

            $this->addFlash('success','Votre compte a été enregistré.');
            return $this->render('user/index.html.twig', [
              'user_form' => $form->createView(),
            ]);
            
        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'user_form' => $form->createView(),
        ]);
    }
}
