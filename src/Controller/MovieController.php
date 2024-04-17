<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Repository\MovieRepository;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('', name: 'app_movie_index')]
    public function index(Request $request, MovieRepository $repository): Response
    {
        $movies = Pagerfanta::createForCurrentPageWithMaxPerPage(
            new QueryAdapter($repository->createQueryBuilder('m')),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Template('movie/show.html.twig')]
    #[Route('/{id}', name: 'app_movie_show', requirements: ['id' => '[0-7][0-9A-HJKMNP-TV-Z]{25}'])]
    public function show(?Movie $movie): array
    {
        return ['movie' => $movie];
    }

    public function decades(): Response
    {
        $decades = [
            ['year' => '90'],
            ['year' => '80'],
            ['year' => '70'],
        ];

        return $this->render('includes/_decades.html.twig', [
            'decades' => $decades,
        ])->setTtl(3600);
    }
}
