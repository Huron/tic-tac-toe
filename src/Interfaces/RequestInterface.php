<?php

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
     * @param string $name
     * @param string|null $default
     *
     * @return string|null
     */
    public function get(string $name, ?string $default = null): ?string;
}
