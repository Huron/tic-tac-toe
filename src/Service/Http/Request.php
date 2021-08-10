<?php

namespace App\Service\Http;

use App\Exception\JsonDecodingException;
use App\Interfaces\RequestInterface;

/**
 * Request.
 */
class Request implements RequestInterface
{
    private array $getData;
    private array $postData;
    private array $serverData;

    /**
     * @param array $get
     * @param array $post
     * @param array $server
     */
    public function __construct(array $get, array $post, array $server)
    {
        $this->getData = $get;
        $this->postData = $post;
        $this->serverData = $server;
    }

    /** {@inheritdoc}
     *
     * @throws JsonDecodingException
     */
    public function getJsonData(): \stdClass
    {
        $inputJSON = file_get_contents('php://input');
        if (!is_string($inputJSON)) {
            throw new JsonDecodingException();
        }
        try {
            return json_decode($inputJSON, false, 512 , JSON_THROW_ON_ERROR);
        } catch (\Throwable $e) {
            throw new JsonDecodingException();
        }
    }

    /**
     * @param string $name
     * @param string|null $default
     *
     * @return string|null
     */
    public function get(string $name, ?string $default = null): ?string
    {
        return $this->getData[$name] ?? $default;
    }
}