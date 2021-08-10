<?php

namespace App\Exception;

use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * WrongArgumentException.
 */
class WrongArgumentException extends AbstractHttpException
{
    /**
     * @param string $message
     * @param Throwable|null $previous
     */
    public function __construct($message = "wrong argument", Throwable $previous = null)
    {
        parent::__construct($message, HttpStatusCode::BAD_REQUEST, $previous);
    }
}