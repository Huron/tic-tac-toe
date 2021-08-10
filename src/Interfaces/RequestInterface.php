<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * RequestInterface.
 */
interface RequestInterface
{
    public function getJsonData(): \stdClass;

    public function get(string $name, ?string $default = null): ?string;
}
