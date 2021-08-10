<?php

declare(strict_types=1);

namespace App\Interfaces;

/**
 * RequestInterface.
 */
interface RequestInterface
{
    /**
     * @return \stdClass
     */
    public function getJsonData(): \stdClass;

    /**
     * @param string      $name
     * @param null|string $default
     *
     * @return null|string
     */
    public function get(string $name, ?string $default = null): ?string;
}
