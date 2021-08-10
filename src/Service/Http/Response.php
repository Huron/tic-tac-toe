<?php

declare(strict_types=1);

namespace App\Service\Http;

use App\Interfaces\ResponseInterface;

/**
 * Response.
 */
class Response implements ResponseInterface
{
    private int $statusCode;
    private ?string $content;
    private array $headers;
    private string $contentType;

    /**
     * @param int         $statusCode
     * @param null|string $content
     * @param array       $headers
     */
    public function __construct(int $statusCode = HttpStatusCode::OK, ?string $content = null, array $headers = [], string $contentType = 'application/json')
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $this->headers = $headers;
        $this->contentType = $contentType;
    }

    /** {@inheritdoc} */
    public function send(): void
    {
        http_response_code($this->statusCode);
        header(sprintf('Content-Type: %s', $this->contentType));
        foreach ($this->headers as $name => $value) {
            header(sprintf('%s: %s', $name, $value));
        }
        echo $this->content;
    }
}
