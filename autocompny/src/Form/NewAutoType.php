<?php

namespace App\Form;

use App\Entity\Autos;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewAutoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('model')
            ->add('type')
            ->add('gewicht')
            ->add('prijs')
            ->add('voorraad')
            ->add('kleur' , ChoiceType::class, [
                'choices'  => [
                    'zwart' => 'zwart',
                    'wit' => 'wit',
                    'zilver' => 'zilver',
                ],
            ])
            ->add('add', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Autos::class,
        ]);
    }
}
