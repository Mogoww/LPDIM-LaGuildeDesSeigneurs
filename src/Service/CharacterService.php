<?php

namespace App\Service;

use DateTime;
use App\Entity\Character;
use Doctrine\ORM\EntityManagerInterface;

class CharacterService implements CharacterServiceInterface
{
    private $em;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /*
    * {@inheritdoc}
    */
    public function create()
    {
        $character = new Character();
        $character
            ->setKind('Dame')
            ->setName('Dagnir')
            ->setSurname('Tourmenteur')
            ->setCaste('Lycanthrope')
            ->setKnowledge('Sciences')
            ->setIntelligence(100)
            ->setLife(14)
            ->setImage('/images/dagnir.jpg')
            ->setCreation(new \DateTime())
            ->setIdentifier(hash('sha1',uniqid()));
        $this->em->persist($character);
        $this->em->flush();

        return $character;
    }
}
