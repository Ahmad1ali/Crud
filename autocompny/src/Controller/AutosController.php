<?php

namespace App\Controller;

use App\Entity\Autos;
use App\Form\NewAutoType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AutosRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AutosController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AutosRepository $autosRepository): Response
    {
        $show = $autosRepository->findAll();

        return $this->render('autos/index.html.twig', [
            'Show' => $show,
        ]);
    }

    #[Route('/add', name: 'app_autos')]
    public function insert ( Request $request , EntityManagerInterface $entityManager): Response
    {
        $add = new NewAutoType();

        $form = $this->createForm(NewAutoType::class, $add);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $add = $form->getData();
            $entityManager->persist($add);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('autos/add.html.twig', [
            'form' => $form,
        ]);
    }
}
