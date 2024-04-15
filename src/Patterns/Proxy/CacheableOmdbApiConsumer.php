<?php

namespace App\Patterns\Proxy;

use App\Patterns\Decorator\OmdbApiConsumer;
use Symfony\Component\Cache\CacheItem;
use Symfony\Contracts\Cache\CacheInterface;

class CacheableOmdbApiConsumer extends OmdbApiConsumer
{
    public function __construct(
        protected CacheInterface $cache,
        protected OmdbApiConsumer $consumer,
    )
    {
    }

    public function fetch(string $type, string $value): array
    {
        return $this->cache->get(
            sprintf("%s-%s", $type, htmlspecialchars($value)),
            function (CacheItem $item) use ($type, $value) {
                $item->expiresAfter(3600);

                return $this->consumer->fetch($type, $value);
            }
        );
    }
}
