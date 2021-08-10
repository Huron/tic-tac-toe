<?php

namespace App\Exception\Validation;

use Throwable;

/**
 * WrongMoveException.
 */
class WrongMoveException extends AbstractValidationException
{
    /**
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong move', $previous);
    }
}