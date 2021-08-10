<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * ResponseInterface.
 */
interface ResponseInterface
{
    public function getContent(): ?string;

    public function getContentType(): string;

    public function getStatusCode(): int;

    /**
     * Send.
     */
    public function send(): void;
}
