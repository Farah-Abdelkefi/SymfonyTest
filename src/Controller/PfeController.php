<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\PfeType;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    #[Route('/pfe', name: 'app_pfe')]
class PfeController extends AbstractController
{
    #[Route('/add',name: 'addPfe')]
    public function addPfe (ObjectManager $manager, Request $request): Response
    {
        $pfe = new PFE();
        $form=$this->createForm(PfeType::class,$pfe);
        $form->handleRequest($request);
        if ($form->isSubmitted() ){
            $manager->persist($pfe);
            $manager->flush();
        }


        return $this->render('pfe/add.html.twig', [
            'form'=>$form->createView()
        ]);
    }
    #[Route('/', name : 'index' )]
    public function index(ManagerRegistry $doctrine){
        $repo = $doctrine->getRepository(PFE::class);
        $pfe=$repo->findAll();
        $this->render('pfe/index.html.twig');

    }
}
