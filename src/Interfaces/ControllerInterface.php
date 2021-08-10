<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * ControllerInterface.
 */
interface ControllerInterface
{
    public function execute(RequestInterface $request): ResponseInterface;
}
