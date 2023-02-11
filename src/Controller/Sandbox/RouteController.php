<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/sandbox/route', name: 'sandbox_route')]
class RouteController extends AbstractController
{


    #[Route(
        '/with-variable/{age}',
     name: '_with_variable',
     )]
    public function withVariableAction(int $age): Response
    {
        return new Response('<body>Age: ' . $age . '</body>');
    }

    #[Route(
        '/with-default/{age}',
     name: '_with_default', 
     defaults: ['age' => 18],
     )]
    public function withDefaultAction(int $age): Response
    {
        dump($age);
        return new Response("<body>Route::withDefault : age = " . $age . "(" . gettype($age) . ")</body>");
    }

}