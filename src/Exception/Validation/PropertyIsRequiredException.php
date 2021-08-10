<?php

declare(strict_types=1);

namespace App\Exception\Validation;

use Throwable;

/**
 * PropertyIsRequiredException.
 */
class PropertyIsRequiredException extends AbstractValidationException
{
    public function __construct(string $propertyName, Throwable $previous = null)
    {
        parent::__construct(sprintf('Property %s is required', $propertyName), $previous);
    }
}
