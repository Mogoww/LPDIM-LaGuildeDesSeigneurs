<?php

namespace App\Service;

use App\Entity\Player;

interface PlayerServiceInterface
{

    /*
    * Gets all the players
    */
    public function getAll();

    /*
    * Creates the players
    */
    public function create();

    /*
    * Modify the players
    */
    public function modify(Player $player);

    /*
    * Modify the character
    */
    public function delete(Player $player);
}
