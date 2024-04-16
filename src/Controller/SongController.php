<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Attribute\Template;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
class SongController
{
    #[Route('/song', name: 'app_song_index')]
    #[Template('book/index.html.twig')]
    public function __invoke()
    {
        return ['controller_name' => 'SongController'];
    }
}
