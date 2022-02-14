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
    * Delete the character
    */
    public function delete(Character $character);

    /*
    * Gets images brandomly
    */
    public function getImages(int $number, ?string $kind = null);

    /*
    * Gets images brandomly using kind
    */
    public function getImagesKind(string $kind, int $number);
}
