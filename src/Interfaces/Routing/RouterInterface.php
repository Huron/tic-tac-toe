<?php

declare(strict_types=1);

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
     * @return null|RouteInterface
     */
    public function getRoute(string $url, string $method): ?RouteInterface;
}
