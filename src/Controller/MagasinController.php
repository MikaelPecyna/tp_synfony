<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/magasin', name: 'app_magasin')]
class MagasinController extends AbstractController
{
    #[Route(
        '/valeur-stock/{id}', 
        name: '_valeur_stock')]
    public function valeurStockAction(int $id): Response
    {
        dump($id);
        return $this->render('Magasin/Valeur_stock.html.twig', ['value' => 154323]);
    }
}
