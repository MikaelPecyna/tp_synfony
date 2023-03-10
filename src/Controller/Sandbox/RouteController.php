<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


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

    #[Route(
        '/with-constraint/{age}',
        name:'_with_constraint', 
        requirements: ['age' => '0|[1-9]\d*'], 
        defaults: ['age' => 18],
    )]
    public function withConstraintAction($age): Response 
    {
        dump($age);
        return new Response('<body> Route::withConstraint : age = ' . $age . '(' . gettype($age) .")</body>" );
    }

    #[Route(
        '/test1/{year}/{month}/{filename}.{ext}',
        name: '_test1', 
    )]
        public function test1Action(int $year, int $month, $filename, $ext): Response
        {
            $args = array(
                'title' => 'Test1',
                'year' => $year,
                'month' => $month,
                'filename' => $filename,
                'ext' => $ext, 
            );

            return $this->render('Sandbox/Route/test1.html.twig', $args);
        }
        #
            public function test2Action(int $year, int $month, string $filename, string $ext): Response
            {
                $args = array(
                    'title' => 'Test2',
                    'year' => $year,
                    'month' => $month,
                    'filename' => $filename,
                    'ext' => $ext, 
                );
    
                return $this->render('Sandbox/Route/test1.html.twig', $args);
            }

        #[Route(
            '/test3/{year}/{month}/{filename}.{ext}',
            name: '_test3', 
            requirements: [
                'year' => '[1-9]\d{0,3}',
                'month' => '(0?[1-9])|(1[0-2])',
                'filename' => '[-a-zA-Z]+', 
                'ext' => 'png|jpg|jpeg|ppm',
            ],
            defaults: [
                'year' => 2021,
                'month' => 01,
                'filename' => 'img',
                'ext' => 'jpg',
            ]
        )]
        public function test3Action(int $year, int $month, string $filename, string $ext): Response{

            $args = array(
                'title' => 'Test3',
                'year' => $year,
                'month' => $month,
                'filename' => $filename,
                'ext' => $ext, 
            );
            

            return $this->render('Sandbox/Route/test1.html.twig', $args);
        }

        // Flemme test4 et test4bis, je l'ai est d??j?? test?? sans le savoir 

        #[Route(
            "/permis/{age}",
            name: '_permis',
            requirements : ['age' => '\d+'],
        )]
        public function permisAction($age): Response
        {
            if($age<18)
                throw new NotFoundHttpException('Il faut ??tre majeur pour acceder ?? cette partie !');
            
            return new Response('<body> Route::permis : age = ' . $age . '</body>');
        }

        #[Route(
            '/redirect1',
            name: '_redirect',
        )]
        public function redirectAction(): Response
        {
            return $this->redirectToRoute('sandbox_prefix_hello4');
        }

        #[Route(
            '/redirect2',
            name: '_redirect2',
        )]
        public function redirect2Action(): Response
        {
            $args = array(
                'title' => 'Test3',
                'year' => 2023,
                'month' => 01,
                'filename' => 'test',
                //'ext' => 'png', 
            );
            return $this->redirectToRoute('sandbox_route_test3', $args);
        }

        #[Route(
            '/redirect3',
            name: '_redirect3',
        )]
        public function redirect3Action(): Response
        {
            dump("Hello world");
            return $this->redirectToRoute('sandbox_prefix_hello4');
        }

        
        
}