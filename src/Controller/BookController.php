<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('', name: 'app_book_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController::index',
        ]);
    }

    #[Route(
        '/show/{id<\d+>?}',
        name: 'app_book_show',
        methods: ['GET'],
        //condition: "request.headers.get('x-sso-header') == 'foobar'",
        priority: 1
    )]
    public function show(?int $id = null): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController::show : '.$id,
        ]);
    }
}
