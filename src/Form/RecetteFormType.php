<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recette;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;

class RecetteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Le nom de la recette est manquant']),
                    new Length([
                        'max'=>100,
                        'maxMessage'=>'Le nom de votre recette ne peut comporter plus de {{limit}} caractères.'
                    ])

                ]
            ])
            ->add('description',TextType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Merci de mettre une brève description de votre recette ']),
                    new Length([
                        'max'=>100,
                        'maxMessage'=>'Votre description de votre recette de 100 caractères.'
                    ])
                ]
            ])

            ->add('nbr_pers',IntegerType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Merci de renseigner le nombre de personnes pour cette recette'])
                ]
            ])

            ->add('tps_total',IntegerType::class)
            ->add('tps_cuisson',IntegerType::class)
            ->add('tps_prepare',IntegerType::class)
            ->add('preparation',TextareaType::class,[
                'constraints'=>[
                    new notBlank(['message'=>'Merci de remplir les étapes de votre recette'])
                ]
            ])
            ->add('imageFile',FileType::class,[
                'required'=>false,
                // 'mapped'=>false
                // 'placeholder'=>'blabla'
            ])
        
            ->add('ingredients',CollectionType::class,[
                'entry_type'=> IngredientFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference'=>false,
                'constraints'=>[
                    new Count([
                        'min'=>1
                    ])
                ]  
            ])
            ->add('ustensiles',CollectionType::class,[
                'entry_type'=> UstensileFormType::class,
                'allow_add' => true,
                'by_reference'=>false,
                'constraints'=>[
                    new Count([
                        'min'=>1
                    ])
                ]    

            ])

            // ->add('user',TextType::class)
            
        ;
    }

        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                // Configure your form options here
                'data_class'=>Recette::class
            ]);
        }
}
