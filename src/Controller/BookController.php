<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
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
        // condition: "request.headers.get('x-sso-header') == 'foobar'",
        priority: 1
    )]
    public function show(?string $id, BookRepository $repository): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $repository->find($id),
        ]);
    }

    #[Route('/{title<\w+>}', name: 'app_book_by_title')]
    public function byTitle(string $title, BookRepository $repository): Response
    {
        return $this->render('book/show.html.twig', [
            'book' => $repository->findLikeTitle($title),
        ]);
    }

    #[Route('/new', name: 'app_book_new', methods: ['GET', 'POST'], priority: 1)]
    #[Route('/{id}/edit', name: 'app_book_edit', requirements: ['id' => '[0-7][0-9A-HJKMNP-TV-Z]{25}'], methods: ['GET', 'POST'])]
    public function save(?Book $book, Request $request, BookRepository $repository): Response
    {
        $book ??= new Book();
        $form = $this->createForm(BookType::class, $book);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $repository->save($book, true);

            return $this->redirectToRoute('app_book_show', ['id' => $book->getId()]);
        }

        return $this->render('book/new.html.twig', [
            'form' => $form,
        ]);
    }
}
