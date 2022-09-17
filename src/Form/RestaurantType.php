<?php

namespace App\Form;

use App\Entity\Restaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ])
            ->add('numero', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('image', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Restaurant::class,
        ]);
    }
}
