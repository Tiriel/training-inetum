<?php

namespace App\Patterns\Decorator;

use Psr\Log\LoggerInterface;

class LoggableOmdbApiConsumer extends OmdbApiConsumer
{
    public function __construct(
        protected LoggerInterface $logger,
        protected OmdbApiConsumer $consumer,
    )
    {
    }

    public function fetch(string $type, string $value): array
    {
        $this->logger->info(sprintf('Searching for movie with %s = %s', $type, $value));

        return $this->consumer->fetch($type, $value);
    }
}
