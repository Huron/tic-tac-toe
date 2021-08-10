<?php

declare(strict_types=1);

namespace App\Exception\Validation;

use Throwable;

/**
 * UnexpectedPropertyException.
 */
class UnexpectedPropertyException extends AbstractValidationException
{
    /**
     * @param string         $propertyName
     * @param null|Throwable $previous
     */
    public function __construct(string $propertyName, Throwable $previous = null)
    {
        parent::__construct(sprintf('Property %s was not expected', $propertyName), $previous);
    }
}
