<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class InscriptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class,[
                'constraints' => [
                    new NotBlank (['message' => 'L\'email est manquant.']), 
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'L\'email ne peut comporter plus de 255 caractères'
                    ])
                    
                ]
            ])
            // ->add('roles')
            
            
            ->add('password', PasswordType::class, [
                'mapped'=> false,
                'constraints' => [
                    new NotBlank (['message' => 'Le password est manquant.']), 
                    new Length([
                        'min' => 8,
                        'maxMessage' => 'Le password doit comporter plus de 8 caractères'
                    ])
                    
                ]
            ])
            ->add('pseudo', TextType::class, [
                'constraints' => [
                    new NotBlank (['message' => 'Le pseudo est manquant.']), 
                    new Length([
                        'max' => 20,
                        'maxMessage' => 'Le pseudo ne peut comporter plus de 20 caractères'
                    ])
                    
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
