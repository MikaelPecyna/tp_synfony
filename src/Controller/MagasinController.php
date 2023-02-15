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
    public function valeurStockAction($id): Response
    {
        dump($id);
        return $this->render('Magasin/Valeur_stock.html.twig', ['value' => 154323]);
    }

    #[Route(
        '/stock/{id}/{valinf}/{valsup}',
        name : "_stock_by_price",
        defaults : [
            'valinf' => 0,
            'valsup' => -1,
        ]
    )]
    public function stockByPriceAction($id, int $valinf, int $valsup)
    {
        $args = array(
            'produits' => array(
                ['nom' => 'RAM',     'prix' => '43', "quantité" => 32],
                ['nom' => 'souris',  'prix' => '85', "quantité" => 24],
                ['nom' => 'clavier', 'prix' => '14', "quantité" => 5 ],
            ),
        );

        return $this->render("Magasin/Stock.html.twig", $args);

    }
}
