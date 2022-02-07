<?php

namespace App\Controller;

use App\Entity\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CharacterServiceInterface;

class CharacterController extends AbstractController
{
    public function __construct(private CharacterServiceInterface $characterService)
    {}



    #[Route('/character', name: 'character', methods:["GET","HEAD"])]
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CharacterController.php',
        ]);
    }

    #[Route('/character/create', name: 'character_create', methods:["POST","HEAD"])]
    public function create()
    {
        $character = $this->characterService->create();
        return new JsonResponse($character -> toArray());
    }






    #[Route('/character/display', name: 'character_display', methods:["GET","HEAD"])]
    public function display(): Response
    {
        $character = new Character();
       ## dump($character);
       # dd($character->toArray());
        return new JsonResponse($character -> toArray());
    }



}
