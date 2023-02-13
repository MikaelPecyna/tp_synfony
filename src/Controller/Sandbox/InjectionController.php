<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


#[Route('sandbox/injection', name: 'app_sandbox_injection')]
class InjectionController extends AbstractController
{
    #[Route('', name: '')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Sandbox/InjectionController.php',
        ]);
    }

    #[Route(
        '/un',
        name: '_un'
    )]
    public function unAction(Request $request): Response
    {
        dump($request->getMethod());
        dump($request->query->get('foo'));
        dump($request->query->all());
        dump($request->cookies->all());

        return new Response('<body>Injection::un</body>');
    }


}
