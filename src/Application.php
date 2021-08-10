<?php

declare(strict_types=1);

namespace App;

use App\Exception\AbstractHttpException;
use App\Exception\FileNotFoundException;
use App\Exception\WrongUrlException;
use App\Interfaces\ControllerInterface;
use App\Interfaces\ResponseInterface;
use App\Service\Http\Request;
use App\Service\Routing\Router;

/**
 * Application.
 */
final class Application
{
    private static ?Application $instance = null;
    private Router $router;

    /**
     * Constructor.
     */
    private function __construct()
    {
        $this->router = new Router();
    }

    /**
     * @return $this
     */
    public static function getInstance(): self
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * @return ResponseInterface
     *
     * @throws AbstractHttpException|\ReflectionException
     */
    public function run(): ResponseInterface
    {
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (!\is_string($uri)) {
            throw new WrongUrlException();
        }
        $route = $this->router->getRoute($uri, $_SERVER['REQUEST_METHOD']);
        if (null === $route) {
            throw new FileNotFoundException();
        }
        /** @var ControllerInterface $controller */
        $controller = $route->getControllerReflection()->newInstance();
        $request = new Request($_GET);

        return $controller->execute($request);
    }
}
