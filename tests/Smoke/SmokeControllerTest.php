<?php

namespace App\Tests\Smoke;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouterInterface;

class SmokeControllerTest extends WebTestCase
{
    private static KernelBrowser $client;
    public static function setUpBeforeClass(): void
    {
        static::$client = static::createClient();
    }

    /**
     * @dataProvider provideMethodAndUri
     */
    public function testPublicPages(string $method, string $uri): void
    {
        static::$client->request($method, $uri);
        if (\in_array(static::$client->getResponse()->getStatusCode(), [301, 302, 307, 308])) {
            static::$client->followRedirect();
        }

        $this->assertEquals(200, static::$client->getResponse()->getStatusCode());
    }

    public function provideMethodAndUri(): iterable
    {
        /** @var RouterInterface $router */
        $router = static::getContainer()->get(RouterInterface::class);
        $collection = $router->getRouteCollection();
        static::ensureKernelShutdown();

        foreach ($collection as $routeName => $route) {
            /** @var Route $route */
            $variable = $route->compile()->getVariables();
            if (\count(array_diff($variable, array_keys($route->getDefaults()))) > 0) {
                continue;
            }
            $methods = $route->getMethods();
            if ([] === $methods) {
                $methods[] = 'GET';
            }

            foreach ($methods as $method) {
                yield "$method $routeName" => [$method, $router->generate($routeName)];
            }
        }
    }
}
