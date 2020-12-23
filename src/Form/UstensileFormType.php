<?php

namespace App\Form;

use App\Entity\Ustensile;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UstensileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=>'Ustensile',
                'constraints'=>[
                    new NotBlank(['message'=>'Le nom des ustensiles est manquant']),
                    new Length([
                        'max'=>25,
                        'maxMessage'=>'Le nom de votre ustensile ne peut comporter plus de 25 caractères.'
                    ])
                ]   
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>Ustensile::class
        ]);
    }
}
