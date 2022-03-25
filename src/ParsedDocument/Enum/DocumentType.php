<?php

namespace ITExperts\Klippa\ParsedDocument\Enum;

enum DocumentType:string
{
    case UNKNOWN = '';
    case INVOICE = 'invoice';
    case RECEIPT = 'receipt';
    case BANK_TRANSACTION = 'bank_transaction';
    case BANK_OVERVIEW = 'bank_overview';
    case PARKING = 'parking';
    case PETROL = 'petrol';
    case TICKET = 'ticket';
    case BOARDING_PASS = 'boarding_pass';
    case BOOKING_PAYMENT_CONFIRMATION = 'booking_payment_confirmation';
    case TAX_AUTHORITY = 'tax_authority';
    case PAYMENT_CARD = 'payment_card';
    case OTHER = 'other';
}