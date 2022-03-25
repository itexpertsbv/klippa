<?php

namespace ITExperts\Klippa\ParsedDocument\Enum;

enum PaymentMethod: string
{
    case UNKNOWN = '';
    case CASH = 'cash';
    case CREDIT_CARD = 'creditcard';
    case PIN = 'pin';
    case BANK = 'bank';
}