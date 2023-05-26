<?php

namespace App\Controller;

use App\Entity\Blague;
use App\Repository\BlagueRepository;
use App\Service\ChuckApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/blague')]
class BlagueController extends AbstractController
{
    #[Route('/', name: 'app_blague')]
    public function index(BlagueRepository $blagueRepository): Response
    {
        return $this->json($blagueRepository->findAll(), 200, [], ['groups'=>'jokes']);
    }

    #[Route('/save', name: 'app_blague_save')]
    public function saveJoke(SerializerInterface $serializer, Request $request, BlagueRepository $blagueRepository, ChuckApiService $chuckApiService): Response
    {
        $json = $request->getContent();
        $blague = $serializer->deserialize($json, Blague::class, 'json');
        $blague->setOwner($this->getUser());
        $blagueRepository->save($blague, true);
        $joke = $chuckApiService->getJokes();
        return $this->json($joke, 200);
    }
}
