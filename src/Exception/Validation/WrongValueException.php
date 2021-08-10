<?php


namespace App\Exception\Validation;


use Throwable;

/**
 * WrongValueException.
 */
class WrongValueException extends AbstractValidationException
{
    /**
     * @param string $propertyName
     * @param Throwable|null $previous
     */
    public function __construct(string $propertyName, Throwable $previous = null)
    {
        parent::__construct(\sprintf('Property %s has wrong value', $propertyName), $previous);
    }
}