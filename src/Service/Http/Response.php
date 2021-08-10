<?php

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

    /**
     * @param int $statusCode
     * @param string|null $content
     * @param array $headers
     */
    public function __construct(int $statusCode = HttpStatusCode::OK, ?string $content = null, array $headers = [])
    {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $this->headers = $headers;
    }

    /** {@inheritdoc} */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /** {@inheritdoc} */
    public function getContentType(): string
    {
        return 'application/json';
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /** {@inheritdoc} */
    public function send(): void
    {
        http_response_code($this->getStatusCode());
        header(\sprintf('Content-Type: %s', $this->getContentType()));
        foreach ($this->headers as $name => $value) {
            header(\sprintf('%s: %s', $name, $value));
        }
        echo $this->getContent();
    }
}