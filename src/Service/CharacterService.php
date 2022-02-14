<?php

namespace App\Service;

use DateTime;
use App\Entity\Character;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Finder\Finder;

class CharacterService implements CharacterServiceInterface
{

    public function __construct(private CharacterRepository $characterRepository, private EntityManagerInterface $em)
    {
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
            ->setModification(new \DateTime())
            ->setIdentifier(hash('sha1', uniqid()));
        $this->em->persist($character);
        $this->em->flush();

        return $character;
    }

    /*
    * {@inheritdoc}
    */
    public function getAll()
    {
        $characterFinal = array();
        $characters = $this->characterRepository->findAll();
        foreach ($characters as $character) {
            $characterFinal[] = $character->toArray();
        }
        return $characterFinal;
    }

    /*
    * {@inheritdoc}
    */
    public function modify(Character $character)
    {
        $character
            ->setKind('Seigneur')
            ->setName('Dagnir')
            ->setSurname('Tourmenteur')
            ->setCaste('Lycanthrope')
            ->setKnowledge('Sciences')
            ->setIntelligence(100)
            ->setLife(14)
            ->setImage('/images/dagnir.jpg')
            ->setModification(new \DateTime());
        $this->em->persist($character);
        $this->em->flush();

        return $character;
    }

    /*
    * {@inheritdoc}
    */
    public function delete(Character $character)
    {
        $this->em->remove($character);
        $this->em->flush();

        return true;
    }

    /*
    * {@inheritdoc}
    */
    public function getImages(int $number, ?string $kind = null)
    {
        $folder = __DIR__ . '/../../public/images/';
        
        $finder = new Finder();
        $finder
            ->files()
            ->in($folder)
            ->notPath('/cartes/')
            ->sortByName()
            ;
        if (null !== $kind){
            $finder->path('/'.$kind.'/');
        }

        $images = array();
        foreach($finder as $file){
            $images[]= '/images/'.$file->getPathname();
        }
        shuffle($images);

        return array_slice($images, 0, $number, true);
    }

    /*
    * {@inheritdoc}
    */
    public function getImagesKind(string $kind, int $number)
    {
        return $this->getImages($number,$kind);
    }
}
