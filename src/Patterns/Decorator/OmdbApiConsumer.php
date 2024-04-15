<?php

namespace App\Patterns\Decorator;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class OmdbApiConsumer
{
    protected HttpClientInterface $client;

    public function __construct()
    {
        $this->client = HttpClient::createForBaseUri('https://www.omdbapi.com', [
            'query' => [
                'apikey' => '77e9a2a5',
                'plot' => 'full'
            ],
        ]);
    }

    public function fetch(string $type, string $value): array
    {
        return $this->client->request('GET', '', ['query' => [ $type => $value]])->toArray();
    }
}
