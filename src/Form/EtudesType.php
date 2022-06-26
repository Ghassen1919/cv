<?php

namespace App\Form;

use App\Entity\Etudes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class EtudesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('emplacement')
            ->add('diplome')
            ->add('date_deb')
            ->add('date_fin')
            ->add('imageFile', VichImageType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etudes::class,
        ]);
    }
}
