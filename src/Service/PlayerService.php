<?php

namespace App\Service;

use DateTime;
use App\Entity\Player;
use App\Repository\PlayerRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlayerService implements PlayerServiceInterface
{

    public function __construct(private PlayerRepository $playerRepository, private EntityManagerInterface $em)
    {
    }


    /*
    * {@inheritdoc}
    */
    public function create()
    {
        $player = new Player();
        $player
            ->setFirstname('Firstname')
            ->setLastname('Lastname')
            ->setEmail('test@email.com')
            ->setMirian(100)
            ->setIdentifier(hash('sha1', uniqid()))
            ->setCreation(new \DateTime())
            ->setModification(new \DateTime());

        $this->em->persist($player);
        $this->em->flush();

        return $player;
    }

    /*
    * {@inheritdoc}
    */
    public function getAll()
    {
        $playerFinal = array();
        $players = $this->playerRepository->findAll();
        foreach ($players as $player) {
            $playerFinal[] = $player->toArray();
        }
        return $playerFinal;
    }

    /*
    * {@inheritdoc}
    */
    public function modify(Player $player)
    {
        $player
            ->setFirstname('Update')
            ->setLastname('Lastname')
            ->setEmail('test@email.com')
            ->setMirian(100)
            ->setModification(new \DateTime());
        $this->em->persist($player);
        $this->em->flush();

        return $player;
    }

    /*
    * {@inheritdoc}
    */
    public function delete(Player $player)
    {
        $this->em->remove($player);
        $this->em->flush();

        return true;
    }
}
