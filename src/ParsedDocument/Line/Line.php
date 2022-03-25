<?php

namespace ITExperts\Klippa\ParsedDocument\Line;

class Line
{
    /**
     * @param int|null $amount
     * @param int|null $amountEach
     * @param int|null $amountExVat
     * @param string|null $description
     * @param float|null $quantity
     * @param string|null $sku
     * @param string|null $title
     * @param string|null $unitOfMeasurement
     * @param int|null $vatAmount
     * @param string|null $vatCode
     * @param int|null $vatPercentage
     */
    public function __construct(
        readonly public ?int $amount,
        readonly public ?int $amountEach,
        readonly public ?int $amountExVat,
        readonly public ?string $description,
        readonly public ?float $quantity,
        readonly public ?string $sku,
        readonly public ?string $title,
        readonly public ?string $unitOfMeasurement,
        readonly public ?int $vatAmount,
        readonly public ?string $vatCode,
        readonly public ?int $vatPercentage
    ){}
}