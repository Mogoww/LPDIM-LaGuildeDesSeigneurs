<?php

namespace App\Controller;

use App\Entity\Character;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/character/display/{identifier}', name: 'character_display', requirements: ["identifier" => "^([a-z0-9]{40})$"], methods: ["GET", "HEAD"])]
    public function display(Character $character): Response
    {
        $this->denyAccessUnlessGranted('characterDisplay', $character);
        return new JsonResponse($character->toArray());
    }

    #[Route('/character/create', name: 'character_create', methods: ["POST", "HEAD"])]
    public function create(Request $request)
    {
        $this->denyAccessUnlessGranted('characterDisplay', null);
        $character = $this->characterService->create($request->getContent());
        return new JsonResponse($character->toArray());
    }

    #[Route('/character/modify/{identifier}', name: 'character_modify', requirements: ["identifier" => "^([a-z0-9]{40})$"], methods: ["PUT", "HEAD"])]
    public function modify(Request $request,Character $character)
    {
        $this->denyAccessUnlessGranted('characterModify', $character);
        $character = $this->characterService->modify($character,$request->getContent());
        return new JsonResponse($character->toArray());
    }

    #[Route('/character/delete/{identifier}', name: 'character_delete', requirements: ["identifier" => "^([a-z0-9]{40})$"], methods: ["DELETE", "HEAD"])]
    public function delete(Character $character)
    {
        $this->denyAccessUnlessGranted('characterDelete', $character);
        $response = $this->characterService->delete($character);
        return new JsonResponse(array('delete' => $response));
    }

    #[Route('/character/images/{number}', name: 'character_images', requirements: ["number" => "^([0-9]{1,2})$"], methods: ["GET", "HEAD"])]
    public function image(int $number)
    {
        $this->denyAccessUnlessGranted('characterIndex', null);
        $images = $this->characterService->getImages($number);
        return new JsonResponse($images);
    }

    #[Route('/character/images/{kind}/{number}', name: 'character_images_kind', requirements: ["number" => "^([0-9]{1,2})$","kind"=>"^(dames|seigneurs|ennemis|ennemies)$"], methods: ["GET", "HEAD"])]
    public function imageKind(string $kind, int $number)
    {
        $this->denyAccessUnlessGranted('characterIndex', null);
        $images = $this->characterService->getImagesKind($kind,$number);
        return new JsonResponse($images);
    }
}
