<?php

namespace Tests\ITExperts\Klippa;

use GuzzleHttp\Psr7\Response;
use ITExperts\Klippa\Client\Client;

class FailingClient extends Client
{
    /**
     * @inheritDoc
     */
    public function credits(): array
    {
        $data = '';

        $this->validateResponse($data, 200, '');

        $data = \json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        return $data['data'];
    }

    /**
     * @inheritDoc
     */
    public function parseDocumentFromBase64(string $base64Content): array
    {
        $data = file_get_contents('tests/fixtures/invoice.json');

        $this->validateResponse($data, 501, 'server fault');

        $data = \json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        return $data['data'];
    }

    /**
     * @inheritDoc
     */
    public function parseDocumentFromUrl(string $url): array
    {
        return [];
    }
}