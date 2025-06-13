<?php

namespace App\Form\DataTransformer;

use App\Entity\CollectiviteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToCollectiviteTypeTransformer implements DataTransformerInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * Transforms an object to a string.
     *
     * @param  CollectiviteType|null $collectiviteType
     */
    public function transform($collectiviteType): ?string
    {
        if (null === $collectiviteType) {
            return null;
        }
        return $collectiviteType->getLabel();
    }

    /**
     * Transforms a string to an object.
     *
     * @param  string $label
     * @throws TransformationFailedException if object is not found.
     */
    public function reverseTransform($label): ?CollectiviteType
    {
        $collectiviteType = $this->entityManager
            ->getRepository(CollectiviteType::class)
            ->findOneBy(['label' => $label])
        ;

        if (null === $collectiviteType) {
            throw new TransformationFailedException(sprintf(
                'Aucun type de collectivité avec le nom "%s" n\'a été trouvé',
                $label
            ));
        }
        return $collectiviteType;
    }
}