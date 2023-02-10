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
     name: '_with_variable')]
    public function withVariableAction(int $age): Response
    {
        return new Response('<body>Age: ' . $age . '</body>');
    }

}