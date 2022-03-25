<?php

namespace ITExperts\Klippa\ParsedDocument\Barcode;

class Barcode
{
    /**
     * @param Type $type
     * @param string $barcode
     */
    public function __construct(
        readonly Type $type,
        readonly string $barcode
    ){}
}