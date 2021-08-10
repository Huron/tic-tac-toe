<?php

namespace App\Exception\Validation;

use Throwable;

/**
 * WrongGameStageException.
 */
class WrongGameStageException extends AbstractValidationException
{
    /**
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong game state', $previous);
    }
}