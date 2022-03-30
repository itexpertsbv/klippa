<?php

namespace ITExperts\Klippa;

use ITExperts\Klippa\Client\Client;
use ITExperts\Klippa\Client\HttpClient;
use ITExperts\Klippa\Credits\CreditsResult;
use ITExperts\Klippa\ParsedDocument\Financial;

class Klippa
{
    public function __construct(private Client $client){}

    /**
     * @return CreditsResult
     */
    public function credits(): CreditsResult
    {
        $result = $this->client->credits();

        return new CreditsResult(
            $result['UsedCredits'],
            $result['SpendableCredits'],
            $result['AvailableCredits'],
            $result['UsesCreditSystem']
        );
    }

    /**
     * @param string $base64Content
     * @return Financial
     */
    public function parseDocumentFromBase64(string $base64Content): Financial
    {
        $data = $this->client->parseDocumentFromBase64($base64Content);

        return $this->parseDocument($data);
    }

    /**
     * @param string $url
     * @return Financial
     */
    public function parseDocumentFromUrl(string $url): Financial
    {
        $data = $this->client->parseDocumentFromUrl($url);

        return $this->parseDocument($data);
    }

    /**
     * @param array $data
     * @return Financial
     * @throws ResponseCouldNotBeParsedException
     */
    private function parseDocument(array $data): Financial
    {
        try {
            return Financial::fromArray($data);
        } catch (\Throwable $e) {
            throw new ResponseCouldNotBeParsedException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param string $key
     * @return static
     */
    public static function HttpClient(string $key): self
    {
        $client = new HttpClient($key);
        return new self($client);
    }
}