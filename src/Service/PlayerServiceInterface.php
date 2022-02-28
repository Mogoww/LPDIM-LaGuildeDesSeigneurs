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
    public function create(string $data);

    /*
    * Checks if the entity has been well filled
    */
    public function isEntityFilled(Player $player);
    
    /* 
    * Submits the data to hydrate the object
    */
    public function submit(Player $player, $formName, $data);



    /*
    * Modify the players
    */
    public function modify(Player $player, string $data);

    /*
    * Modify the character
    */
    public function delete(Player $player);
}
