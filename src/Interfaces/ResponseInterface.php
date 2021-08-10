<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * ResponseInterface.
 */
interface ResponseInterface
{
    /**
     * @return null|string
     */
    public function getContent(): ?string;

    /**
     * @return string
     */
    public function getContentType(): string;

    /**
     * @return int
     */
    public function getStatusCode(): int;

    /**
     * Send.
     */
    public function send(): void;
}
