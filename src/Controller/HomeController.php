<?php

namespace App\Controller;

use App\Service\ChuckApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/chuck', name: 'app_chuck')]
    public function chuck(ChuckApiService $chuckApiService): Response
    {
        $arrayjokes = [];
        for ($i=0;$i<=10;$i++){
            $arrayjokes[] = $chuckApiService->getJokes();
        }
        return $this->render('home/chuck.html.twig',[
            'jokes'=>$arrayjokes
        ]);
    }
    #[Route('/chuckone', name: 'app_chuck_one')]
    public function chuckOne(ChuckApiService $chuckApiService): Response
    {
        $data = $chuckApiService->getJokes();
        return $this->json($data, 200);
    }
}
