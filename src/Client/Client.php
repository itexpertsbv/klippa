<?php

namespace ITExperts\Klippa\Client;

use Psr\Http\Message\ResponseInterface;

abstract class Client
{
    /**
     * @return array
     */
    abstract public function credits(): array;

    /**
     * @param string $base64Content
     * @return array
     */
    abstract public function parseDocumentFromBase64(string $base64Content): array;

    /**
     * @param string $url
     * @return array
     */
    abstract public function parseDocumentFromUrl(string $url): array;

    /**
     * @param ResponseInterface $response
     * @return void
     * @throws RequestFailedException
     * @throws JsonDecodeFailedException
     */
    protected function validateResponse(ResponseInterface $response): void
    {
        try {
            $data = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new JsonDecodeFailedException($e->getMessage(), $e->getCode());
        }

        if ($data['result'] !== 'success' || $response->getStatusCode() >= 400) {
            throw new RequestFailedException(
                $data['message'] ?? $response->getReasonPhrase(),
                $data['code'] ??
                $response->getStatusCode(),
                $data['request_id'] ?? null
            );
        }
    }
}