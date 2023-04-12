<?php

namespace App\Controller;

use App\Entity\Autos;
use App\Repository\AutosRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AutosController extends AbstractController
{
    #[Route('/', name: 'app_autos')]
    public function index(AutosRepository $autosRepository): Response
    {
        $show = $autosRepository->findAll();

        return $this->render('autos/index.html.twig', [
            'Show' => $show,
        ]);
    }
}
