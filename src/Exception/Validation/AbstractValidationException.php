<?php

declare(strict_types=1);

namespace App\Exception\Validation;

use App\Exception\AbstractHttpException;
use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * AbstractValidationException.
 */
abstract class AbstractValidationException extends AbstractHttpException
{
    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, HttpStatusCode::BAD_REQUEST, $previous);
    }
}
