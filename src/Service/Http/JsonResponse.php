<?php

namespace App\Service\Http;

use App\Exception\JsonEncodingException;

/**
 * JsonResponse.
 */
class JsonResponse extends Response
{
    /**
     * @param mixed $data
     * @param int $statusCode
     * @param array $headers
     *
     * @throws JsonEncodingException
     */
    public function __construct($data, int $statusCode = HttpStatusCode::OK, array $headers = [])
    {
        $json = json_encode($data);
        if (!is_string($json)) {
            throw new JsonEncodingException();
        }
        parent::__construct($statusCode, $json, $headers);
    }
}