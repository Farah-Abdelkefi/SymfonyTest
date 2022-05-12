<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\PFE;
use App\Form\PfeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PfeController extends AbstractController
{
    #[Route('pfe/add',name: 'addPfe')]
    public function addPfe (EntityManagerInterface $manager, Request $request): Response
    {

        $pfe = new PFE();
        $form=$this->createForm(PfeType::class,$pfe);
        $form->handleRequest($request);
        if ($form->isSubmitted() ){
            $manager->persist($pfe);
            $manager->flush();
            return $this->render('pfe/details.html.twig',[
                'pfe' => $pfe
            ]);
        }


        return $this->render('pfe/add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('pfe/stat', name : 'stat' )]
    public function stat (ManagerRegistry $doctrine): Response {
        $repo = $doctrine->getRepository(Entreprise::class);
        $entreprises =$repo->findAll();
        return $this->render('pfe/stat.html.twig',[
            'entreprises'=>$entreprises
        ]);

    }
    #[Route('/pfe', name: 'app_pfe')]
    public function index (ManagerRegistry $doctrine): Response {
        $repo = $doctrine->getRepository(PFE::class);
        $pfes =$repo->findAll();
        return $this->render('pfe/index.html.twig',[
            'pfes'=>$pfes
        ]);
}}
