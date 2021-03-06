<?php

declare(strict_types=1);

namespace App\Exception\Validation;

use Throwable;

/**
 * WrongGameStageException.
 */
class WrongGameStageException extends AbstractValidationException
{
    /**
     * @param null|Throwable $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong game state', $previous);
    }
}
