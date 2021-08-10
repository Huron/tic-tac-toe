<?php

declare(strict_types=1);

namespace App\Exception;

use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * JsonEncodingException.
 */
class JsonEncodingException extends AbstractHttpException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('JSON encoding error', HttpStatusCode::INTERNAL_SERVER_ERROR, $previous);
    }
}
