<?php

declare(strict_types=1);

namespace App\Exception;

use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * WrongUrlException.
 */
class WrongUrlException extends AbstractHttpException
{
    public function __construct(Throwable $previous = null)
    {
        parent::__construct('Wrong URL', HttpStatusCode::BAD_REQUEST, $previous);
    }
}
