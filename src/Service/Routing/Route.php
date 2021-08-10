<?php

declare(strict_types=1);

namespace App\Service\Routing;

use App\Exception\WrongArgumentException;
use App\Interfaces\Routing\RouteInterface;

/**
 * Route.
 *
 * @Annotation
 */
class Route implements RouteInterface
{
    private string $pattern;
    private array $methods = [];

    private \ReflectionClass $controllerReflection;

    /**
     * @param string[] $values
     *
     * @throws WrongArgumentException
     */
    public function __construct(array $values)
    {
        if (!isset($values['pattern']) || empty($values['pattern'])) {
            throw new WrongArgumentException();
        }
        $this->pattern = sprintf('#%s#i', $values['pattern']);

        if (isset($values['methods']) && !empty($values['methods'])) {
            /** @var array|string $methods */
            $methods = $values['methods'];
            if (!\is_array($methods)) {
                throw new WrongArgumentException();
            }
            $this->methods = array_map(
                function (string $method) {
                    return strtoupper($method);
                },
                $methods
            );
        }
    }

    /** {@inheritdoc} */
    public function isMatch(string $url, array &$match): bool
    {
        return (bool) preg_match($this->pattern, $url, $match);
    }

    /** {@inheritdoc} */
    public function getControllerReflection(): \ReflectionClass
    {
        return $this->controllerReflection;
    }

    /**
     * @return Route
     */
    public function setControllerReflection(\ReflectionClass $controllerReflection): self
    {
        $this->controllerReflection = $controllerReflection;

        return $this;
    }

    /** {@inheritdoc} */
    public function isMethodMatch(string $method): bool
    {
        return empty($this->methods) || \in_array(strtoupper($method), $this->methods, true);
    }
}
