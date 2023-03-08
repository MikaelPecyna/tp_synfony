<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Sandbox\Film;
use Doctrine\ORM\EntityManagerInterface;


#[Route('/sandbox/doctrine', name: 'app_sandbox_doctrine')]
class DoctrineController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listAction(): Response
    {
        $args = array(
        );
        return $this->render('Sandbox/Doctrine/List.html.twig', $args);
    }

    #[Route(
        '/view/{id}',
        name: '_view',
        requirements: ['id' => '\d*'],
        )]
    public function viewAction(int $id): Response
    {
        $args = array(
            'id' => $id,
        );
        return $this->render('Sandbox/Doctrine/View.html.twig', $args);
    }

    #[Route('/delete',
    name: '_delete',
    requirements: ['id' => '\d*'],
    )]
    public function deleteAction(int $id): Response
    {
        $this->addFlash('info', 'Film ' + $id +  ' supprimé');
        return $this->redirectToRoute('app_sandbox_doctrine_list');
    }

    #[Route('/ajouter-en-dur', name: '_ajouter_en_dur')]
    public function ajouterEnDurAction(EntityManagerInterface $em ): Response 
    {
        $film = new Film(); 
        $film 
            ->setTitre('Le Grand Rouge') 
            ->setAnnee(2002)
            ->setEnStock(true) // ! Inutile car la valeur par défaut est true
            ->setPrix(9.99)
            ->setQuantite(123);
        dump($film);

        $em->persist($film); 
        $em->flush(); 
        dump($film);


        return $this->redirectToRoute('app_sandbox_doctrine_view', ['id' => $film->getId()]);
    }
}

