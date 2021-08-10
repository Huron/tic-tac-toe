<?php

namespace App\Exception;

use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * WrongUrlException.
 */
class WrongUrlException extends AbstractHttpException
{
    /**
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong URL', HttpStatusCode::BAD_REQUEST, $previous);
    }
}