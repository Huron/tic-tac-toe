<?php

declare(strict_types=1);

namespace App\Exception;

use Throwable;

/**
 * AbstractHttpException.
 */
abstract class AbstractHttpException extends \Exception
{
    public function __construct(string $message, int $code, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
