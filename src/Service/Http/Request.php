<?php

declare(strict_types=1);

namespace App\Service\Http;

use App\Exception\JsonDecodingException;
use App\Interfaces\RequestInterface;

/**
 * Request.
 */
class Request implements RequestInterface
{
    private array $getData;

    public function __construct(array $get)
    {
        $this->getData = $get;
    }

    /** {@inheritdoc}
     *
     * @throws JsonDecodingException
     */
    public function getJsonData(): \stdClass
    {
        $inputJSON = file_get_contents('php://input');
        if (!\is_string($inputJSON)) {
            throw new JsonDecodingException();
        }

        try {
            return json_decode($inputJSON, false, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            throw new JsonDecodingException();
        }
    }

    public function get(string $name, ?string $default = null): ?string
    {
        return $this->getData[$name] ?? $default;
    }
}
