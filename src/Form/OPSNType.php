<?php

namespace App\Form;

use App\Entity\OPSN;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OPSNType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email')
            ->add('departement')
            ->add('active')
            // ->add('logo')
            ->add('phoneNumber')
            ->add('postalAddress')
            ->add('website')
            ->add('siret')
            ->add('latitude')
            ->add('longitude')
            ->add('departements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OPSN::class,
        ]);
    }
}
