<?php

namespace App\Interfaces\Routing;

/**
 * RouteInterface.
 */
interface RouteInterface
{
    /**
     * @param string $url
     * @param array $match
     *
     * @return bool
     */
    public function isMatch(string $url, array &$match): bool;

    /**
     * @param string $method
     *
     * @return bool
     */
    public function isMethodMatch(string $method): bool;

    /**
     * @return \ReflectionClass
     */
    public function getControllerReflection(): \ReflectionClass;
}
