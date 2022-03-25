<?php

namespace ITExperts\Klippa\ParsedDocument\Line;

class Lines
{
    /**
     * @param string $description
     * @param Line[] $lines
     */
    public function __construct(
        readonly public string $description,
        readonly public array $lines = []
    ){}
}