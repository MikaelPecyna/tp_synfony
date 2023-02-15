<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




#[Route('/produit', name: 'app_produit')]
class ProduitController extends AbstractController
{
    #[Route('', name: '')]
    public function index(): Response
    {
        $params = array(
            'page' => 1,
        );
        return $this->redirectToRoute('app_produit_list_product',$params);
    
    }

    #[Route(
        '/list/{page}',
        name: '_list',
        requirements: ['page' => '[1-9]\d*'],
        defaults: ['page' => 0],
    )]
    public function listAction(int $page): Response
    {

        $args = array(
            'page' => $page,
            'produits' => array(
                ['id' => 2, 'denomination' => 'RAM',     'code' => '97558143', "actif" => false],
                ['id' => 5, 'denomination' => 'souris',  'code' => '35425785', "actif" => true],
                ['id' => 6, 'denomination' => 'clavier', 'code' => '33278214', "actif" => true],
            ),
        );

        dump($args['produits']);
        return $this->render('Produit/List.html.twig', $args);
    }

    #[Route(
        '/view/{id}',
        name: '_view',
        requirements : ['id' => '[1-9]\d*'],
    )]
    public function viewAction(int $id): Response 
    {
        $args = array(
            ['id' => 2, 'denomination' => 'RAM',     'code' => '97558143', "actif" => false],
        );
        dump($args);
        return $this->render('Produit/View.html.twig', $args);
    }

    #[Route (
        '/add',
        name: "_add",
    )]
    public function addAction(): Response
    {
        $this->addFlash('info', 'Création du produit sans problème!');
        return $this->redirectToRoute('app_produit_view', ['id' => 3]);
    }

    #[Route(
        '/edit/{id}',
        name: '_edit',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function editAction(int $id): Response 
    {
        $this->addFlash('info', 'Modification réussi !');
        return $this->redirectToRoute('app_produit_view', ['id' => $id]);
    }

    #[Route(
        '/delete/{id}',
        name: '_delete',
        requirements: ['id' => '[1-9]\d*'],
    )]
    public function deleteAction(int $id): Response 
    {
        $this->addFlash('info', 'Suppression réussi !');
        return $this->redirectToRoute('app_produit_list');
    }

}
