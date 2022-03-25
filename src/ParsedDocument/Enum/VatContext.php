<?php

namespace ITExperts\Klippa\ParsedDocument\Enum;

enum VatContext:string
{
    case UNKNOWN = '';
    case PURCHASE_NONE = 'purchase_none';
    case VAT_EU = 'vat_eu';
    case VAT_REVERSE_CHARGE = 'vat_reverse_charged';
    case VAT_EXEMPTED = 'vat_exempted';
    case VAT_MARGIN = 'vat_margin';
}