<?php

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