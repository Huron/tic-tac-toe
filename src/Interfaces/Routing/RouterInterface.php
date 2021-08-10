<?php

declare(strict_types=1);

namespace App\Interfaces\Routing;

/**
 * RouterInterface.
 */
interface RouterInterface
{
    public function getRoute(string $url, string $method): ?RouteInterface;
}
