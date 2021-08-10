<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * ControllerInterface.
 */
interface ControllerInterface
{
    /**
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function execute(RequestInterface $request): ResponseInterface;
}
