<?php

namespace App\Service;

use App\Entity\Character;

interface CharacterServiceInterface
{
    /*
    * Creates the character
    */
    public function create();

    /*
    * Gets all the characters
    */
    public function getAll();

    /*
    * Modify the character
    */
    public function modify(Character $character);

    /*
    * Modify the character
    */
    public function delete(Character $character);
}
