<?php

namespace ITExperts\Klippa\Client;

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
     * @param string $response
     * @param int $statusCode
     * @param string $reasonPhrase
     * @return void
     * @throws JsonDecodeFailedException
     * @throws RequestFailedException
     */
    protected function validateResponse(string $response, int $statusCode, string $reasonPhrase): void
    {
        if ($statusCode >= 400) {
            throw new RequestFailedException(
                $reasonPhrase,
                $statusCode,
                null
            );
        }

        try {
            $data = json_decode($response, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            throw new JsonDecodeFailedException($e->getMessage(), $e->getCode());
        }

        if ($data['result'] !== 'success') {
            throw new RequestFailedException(
                $data['message'],
                $data['code'],
                $data['request_id']
            );
        }
    }
}