<?php

namespace ITExperts\Klippa\Client;

use ITExperts\Klippa\KlippaException;

class RequestFailedException extends KlippaException
{
    /**
     * @param string $message
     * @param int $code
     * @param string|null $requestId
     */
    public function __construct(
        string $message,
        int $code,
        public readonly ?string $requestId
    ){
        parent::__construct($message, $code);
    }
}