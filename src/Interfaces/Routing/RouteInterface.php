<?php

declare(strict_types=1);

namespace App\Interfaces\Routing;

/**
 * RouteInterface.
 */
interface RouteInterface
{
    public function isMatch(string $url, array &$match): bool;

    public function isMethodMatch(string $method): bool;

    public function getControllerReflection(): \ReflectionClass;
}
