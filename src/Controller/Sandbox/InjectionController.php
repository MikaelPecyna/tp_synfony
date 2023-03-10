<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


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

    #[Route(
        '/deux',
        name: "_deux",
    )]
    public function deuxAction(Request $request, Session $session): Response
    {
        if ($request->query->get('compteur') !== null){
            $session->set('compteur' , $request->query->get('compteur'));
        }elseif($request->query->get('inc') !== null){
            $session->set('compteur', $session->get('compteur') + 1);
        }elseif($request->query->get('supp') !== null){
            $session->remove(('compteur'));
        }

        dump($session->all());
        dump($_SESSION);

        return new Response('<body>Injection::deux</body>');
    }

    #[Route(
        '/create-flash', 
        name: '_create_flash',
    )]
    public function createFlashAction(Session $session): Response
    {
        $session->getFlashBag()->add('info', 'La base de donnée à été mis à jour');
        $this->addFlash('info', 'La base de donnée à été mis à jour (bisRepeta)');
        $this->addFlash('error', 'Erreur lors de la suppression');
        return $this->redirectToRoute('app_sandbox_injection_display_flash');
    }

    #[Route(
        "/display-flash",
        name: '_display_flash',
    )]
    public function displayFlashAction(): Response
    {
        return $this->render('Sandbox/Injection/displayFlash.html.twig');
    }

}
