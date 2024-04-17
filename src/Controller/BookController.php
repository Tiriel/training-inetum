<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('', name: 'app_book_index', methods: ['GET'])]
    public function index(Request $request, BookRepository $repository): Response
    {
        $books = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($repository->createQueryBuilder('b')),
            $request->query->getInt('page', 1),
            6,
        );

        return $this->render('book/index.html.twig', [
            'books' => $books,
        ]);
    }

    #[Route(
        '/show/{id?}',
        name: 'app_book_show',
        requirements: ['id' => '[0-7][0-9A-HJKMNP-TV-Z]{25}'],
        methods: ['GET'],
        //condition: "request.headers.get('x-sso-header') == 'foobar'",
        priority: 1
    )]
    public function show(?string $id, BookRepository $repository): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $repository->find($id),
        ]);
    }

    public function byTitle(string $title, BookRepository $repository): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $repository->findLikeTitle($title),
        ]);
    }
}
