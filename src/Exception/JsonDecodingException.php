<?php

declare(strict_types=1);

namespace App\Exception;

use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * JsonDecodingException.
 */
class JsonDecodingException extends AbstractHttpException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong JSON string in the request', HttpStatusCode::BAD_REQUEST, $previous);
    }
}
