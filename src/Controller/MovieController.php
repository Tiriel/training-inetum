<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('', name: 'app_movie_index')]
    public function index(): Response
    {
        return $this->render('movie/index.html.twig', [
            'controller_name' => 'MovieController::index',
        ]);
    }

    #[Route('/{id<\d+>}', name: 'app_movie_show')]
    public function show(int $id): Response
    {
        $movie = [
            'id' => $id,
            'title' => 'Star Wars - Episode IV : A New Hope',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BOTA5NjhiOTAtZWM0ZC00MWNhLThiMzEtZDFkOTk2OTU1ZDJkXkEyXkFqcGdeQXVyMTA4NDI1NTQx._V1_SX300.jpg',
            'country' => 'United States',
            'releasedAt' => new \DateTimeImmutable('25-05-1977'),
            'genres' => ['Action', 'Adventure', 'Fantasy'],
            'plot' => 'A young farmer breaks his father\'s toy.',
        ];

        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
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
