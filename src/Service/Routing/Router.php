<?php

namespace App\Service\Routing;

use App\Interfaces\ControllerInterface;
use App\Interfaces\Routing\RouteInterface;
use App\Interfaces\Routing\RouterInterface;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Router.
 */
class Router implements RouterInterface
{
    /**
     * @var Route[]
     */
    private array $routes = [];

    public function __construct()
    {
        AnnotationRegistry::registerLoader('class_exists');
        $reader = new AnnotationReader();

        /** @var \Composer\Autoload\ClassLoader $classLoader */
        $classLoader = require(__DIR__.'/../../../vendor/autoload.php');
        foreach ($classLoader->getClassMap() as $className => $file) {
            if (!preg_match('/^App/', $className)) {
                continue;
            }
            $reflection = new \ReflectionClass($className);
            if (!$reflection->isSubclassOf(ControllerInterface::class)) {
                continue;
            }
            $route = $reader->getClassAnnotation($reflection, Route::class);
            if (null === $route) {
                continue;
            }
            $route->setControllerReflection($reflection);
            $this->routes[] = $route;
        }
    }

    /**
     * @param string $url
     * @param string $method
     *
     * @return RouteInterface|null
     */
    public function getRoute(string $url, string $method): ?RouteInterface
    {
        $current = null;
        foreach ($this->routes as $route) {
            $match = [];
            if ($route->isMatch($url, $match) && $route->isMethodMatch($method)) {
                $current = $route;
                foreach ($match as $key => $value) {
                    $_GET[$key] = $value;
                }
                break;
            }
        }

        return $current;
    }
}