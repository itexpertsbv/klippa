<?php

namespace ITExperts\Klippa\ParsedDocument\Enum;

enum InvoiceType:string
{
    case UNKNOWN = '';
    case INVOICE = 'invoice';
    case CREDIT_INVOICE = 'credit_invoice';
    case SELF_BILLING_INVOICE = 'self_billing_invoice';
}