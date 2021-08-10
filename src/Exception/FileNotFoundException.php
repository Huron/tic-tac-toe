<?php

declare(strict_types=1);

namespace App\Exception;

use App\Service\Http\HttpStatusCode;
use Throwable;

/**
 * FileNotFoundException.
 */
class FileNotFoundException extends AbstractHttpException
{
    public function __construct(string $message = 'File Not Found', Throwable $previous = null)
    {
        parent::__construct($message, HttpStatusCode::FILE_NOT_FOUND, $previous);
    }
}
