<?php

declare(strict_types=1);

namespace App\Exception\Validation;

use Throwable;

/**
 * WrongMoveException.
 */
class WrongMoveException extends AbstractValidationException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong move', $previous);
    }
}
