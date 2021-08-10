<?php

namespace App\Interfaces\Routing;

/**
 * RouterInterface.
 */
interface RouterInterface
{
    /**
     * @param string $url
     * @param string $method
     *
     * @return RouteInterface|null
     */
    public function getRoute(string $url, string $method): ?RouteInterface;
}