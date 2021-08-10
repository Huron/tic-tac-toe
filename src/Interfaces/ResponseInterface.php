<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * ResponseInterface.
 */
interface ResponseInterface
{
    /**
     * Send.
     */
    public function send(): void;
}
