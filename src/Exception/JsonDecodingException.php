<?php

namespace App\Exception;

use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * JsonDecodingException.
 */
class JsonDecodingException extends AbstractHttpException
{
    /**
     * @param Throwable|null $previous
     */
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong JSON string in the request', HttpStatusCode::BAD_REQUEST, $previous);
    }
}