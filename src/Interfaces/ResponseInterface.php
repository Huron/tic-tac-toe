<?php

namespace App\Interfaces;

/**
 * ResponseInterface.
 */
interface ResponseInterface
{
    /**
     * @return string|null
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