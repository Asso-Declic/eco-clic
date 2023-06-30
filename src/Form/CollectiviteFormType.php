<?php

namespace App\Form;

use App\Entity\Collectivite;
use App\Form\DataTransformer\StringToCollectiviteTypeTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CollectiviteFormType extends AbstractType
{
    public function __construct(
        private StringToCollectiviteTypeTransformer $stringToCollectiviteTypeTransformer
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('population')
            ->add('siret')
            ->add('latitude')
            ->add('longitude')
            ->add('postalCode')
            ->add('departement')
            ->add('type', TextType::class, [
                'required' => true,
            ])
            ->add('opsn')
        ;
        $builder->get('type')->addModelTransformer($this->stringToCollectiviteTypeTransformer);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Collectivite::class,
        ]);
    }
}
