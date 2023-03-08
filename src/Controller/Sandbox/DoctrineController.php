<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


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
}
