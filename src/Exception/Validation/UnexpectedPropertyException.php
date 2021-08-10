<?php

namespace App\Exception\Validation;

use Throwable;

/**
 * UnexpectedPropertyException.
 */
class UnexpectedPropertyException extends AbstractValidationException
{
    /**
     * @param string $propertyName
     * @param Throwable|null $previous
     */
    public function __construct(string $propertyName, Throwable $previous = null)
    {
        parent::__construct(\sprintf('Property %s was not expected', $propertyName), $previous);
    }
}