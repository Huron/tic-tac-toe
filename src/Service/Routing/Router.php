<?php

declare(strict_types=1);

namespace App\Service\Routing;

use App\Interfaces\ControllerInterface;
use App\Interfaces\Routing\RouteInterface;
use App\Interfaces\Routing\RouterInterface;
use Composer\Autoload\ClassLoader;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;

/**
 * Router.
 */
class Router implements RouterInterface
{
    /**
     * @var RouteInterface[]
     */
    private array $routes = [];

    /**
     * @throws \ReflectionException
     */
    public function __construct()
    {
        AnnotationRegistry::registerLoader('class_exists');
        $reader = new AnnotationReader();

        /** @var ClassLoader $classLoader */
        $classLoader = require __DIR__.'/../../../vendor/autoload.php';
        foreach ($classLoader->getClassMap() as $className => $file) {
            if (!preg_match('/^App/', $className)) {
                continue;
            }
            $reflection = new \ReflectionClass($className);
            if (!$reflection->isSubclassOf(ControllerInterface::class)) {
                continue;
            }
            /** @var null|RouteInterface $route */
            $route = $reader->getClassAnnotation($reflection, Route::class);
            if (null === $route) {
                continue;
            }
            $route->setControllerReflection($reflection);
            $this->routes[] = $route;
        }
    }

    /** {@inheritdoc} */
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
