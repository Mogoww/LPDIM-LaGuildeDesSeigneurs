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
    {
    }



    #[Route('/character', name: 'character_redirect_index', methods: ["GET", "HEAD"])]
    public function redirectIndex()
    {
        return $this->redirectToRoute('character_index');
    }


    #[Route('/character/index', name: 'character_index', methods: ["GET", "HEAD"])]
    public function index()
    {
        $this->denyAccessUnlessGranted('characterIndex', null);
        $character = $this->characterService->getAll();
        return new JsonResponse($character);
    }


    #[Route('/character/create', name: 'character_create', methods: ["POST", "HEAD"])]
    public function create()
    {
        $this->denyAccessUnlessGranted('characterDisplay', null);
        $character = $this->characterService->create();
        return new JsonResponse($character->toArray());
    }

    #[Route('/character/modify/{identifier}', name: 'character_modify', requirements: ["identifier" => "^([a-z0-9]{40})$"], methods: ["PUT", "HEAD"])]
    public function modify(Character $character)
    {
        $this->denyAccessUnlessGranted('characterModify', $character);
        $character = $this->characterService->modify($character);
        return new JsonResponse($character->toArray());
    }






    #[Route('/character/display/{identifier}', name: 'character_display', requirements: ["identifier" => "^([a-z0-9]{40})$"], methods: ["GET", "HEAD"])]
    public function display(Character $character): Response
    {
        $this->denyAccessUnlessGranted('characterDisplay', $character);
        return new JsonResponse($character->toArray());
    }
}
