<?php

namespace ITExperts\Klippa\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Request;

class HttpClient extends Client
{
    private GuzzleClient $client;

    /**
     * @param string $apiKey
     */
    public function __construct(private string $apiKey)
    {
        $this->client = new GuzzleClient([
            'base_uri' => 'https://custom-ocr.klippa.com/api/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'X-Auth-Key' => $this->apiKey
            ]
        ]);
    }

    /**
     * @return array
     */
    public function credits(): array
    {
        $response = $this->client->get('credits');

        $payload = $response->getBody()->getContents();

        $this->validateResponse($payload, $response->getStatusCode(), $response->getReasonPhrase());

        $data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);

        return $data['data'];
    }

    /**
     * @param string $base64Content
     * @return array
     */
    public function parseDocumentFromBase64(string $base64Content): array
    {
        $parameters = [
            'pdf_text_extraction' => 'full',
            'document' => $base64Content
        ];

        $response = $this->client->post(
            'parseDocument',
            [
                'json' => $parameters
            ]
        );

        $payload = $response->getBody()->getContents();

        $this->validateResponse($payload, $response->getStatusCode(), $response->getReasonPhrase());

        $data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);

        return $data['data'];
    }

    /**
     * @param string $url
     * @return array
     */
    public function parseDocumentFromUrl(string $url): array
    {
        $parameters = [
            'pdf_text_extraction' => 'full',
            'url' => $url
        ];

        $response = $this->client->post(
            'parseDocument',
            [
                'json' => $parameters
            ]
        );

        $payload = $response->getBody()->getContents();

        $this->validateResponse($payload, $response->getStatusCode(), $response->getReasonPhrase());

        $data = json_decode($payload, true, 512, JSON_THROW_ON_ERROR);

        return $data['data'];
    }
}