<?php

namespace ITExperts\Klippa\ParsedDocument;

class VatItem
{
    /**
     * @param int|null $amount
     * @param int|null $amount_excl_vat
     * @param int|null $amount_incl_vat
     * @param bool|null $amount_incl_excl_vat_estimated
     * @param int|null $percentage
     * @param string|null $code
     */
    public function __construct(
        readonly public ?int $amount,
        readonly public ?int $amount_excl_vat,
        readonly public ?int $amount_incl_vat,
        readonly public ?bool $amount_incl_excl_vat_estimated,
        readonly public ?int $percentage,
        readonly public ?string $code,
    ){}
}