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
    #[Route('/home', name: 'app_home')]
    public function index(AutosRepository $autosRepository): Response
    {
        $show = $autosRepository->findAll();

        return $this->render('autos/index.html.twig', [
            'Show' => $show,
        ]);
    }

    #[Route('/details/{id}', name: 'app_data')]
    public function details(Autos $autos, AutosRepository $autosRepository): Response
    {
        $details =$autosRepository->findBy( ['id'=>$autos]);

        return $this->render('autos/details.html.twig', [
            'id' => $autos,
            'data' => $details,
        ]);
    }
    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(Autos $delete, EntityManagerInterface $entityManager ,int $id): Response
    {
     $deleteAuto=$delete->getModel();
     $deleteAutos= $entityManager->getRepository(Autos::class)->find($id);
     if (!$deleteAutos){
         throw $this->createNotFoundException(
             'No product found for id '.$id
         );
     }
     $entityManager->remove($deleteAutos);
     $entityManager->flush();

        return $this->redirectToRoute('app_home',[
            'deleteAuto'=>$deleteAuto
        ]);
        
    }


    #[Route('/update/{id}', name: 'app_update')]
    public function update ( Autos $autos, AutosRepository $autosRepository ,Request $request , EntityManagerInterface $entityManager): Response
    {
        $autoId=$autos->getId();
        $auto =$entityManager->getRepository(Autos::class)->find($autoId);

        $form = $this->createForm(NewAutoType::class, $auto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $add = $form->getData();
            $entityManager->persist($add);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->renderForm('autos/update.html.twig', [
            'id' =>$auto,
            'form' => $form,
        ]);
    }


    #[Route('/add', name: 'app_autos')]
    public function insert ( Request $request , EntityManagerInterface $entityManager): Response
    {
        $add = new Autos();

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
