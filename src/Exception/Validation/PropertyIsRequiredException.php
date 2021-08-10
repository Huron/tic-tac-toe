<?php

namespace App\Exception\Validation;

use Throwable;

/**
 * PropertyIsRequiredException.
 */
class PropertyIsRequiredException extends AbstractValidationException
{
    /**
     * @param string $propertyName
     * @param Throwable|null $previous
     */
    public function __construct(string $propertyName, Throwable $previous = null)
    {
        parent::__construct(\sprintf('Property %s is required', $propertyName), $previous);
    }
}