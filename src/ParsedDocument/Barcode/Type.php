<?php

namespace ITExperts\Klippa\ParsedDocument\Barcode;

enum Type:string
{
    case UNKNOWN = '';
    case AZTEC = 'AZTEC';
    case CODABAR = 'CODABAR';
    case CODE39 = 'CODE39';
    case CODE93 = 'CODE93';
    case CODE128 = 'CODE128';
    case DATAMATRIX = 'DATAMATRIX';
    case EAN8 = 'EAN8';
    case EAN13 = 'EAN13';
    case ITF = 'ITF';
    case MAXICODE = 'MAXICODE';
    case PDF417 = 'PDF417';
    case QRCODE = 'QRCODE';
    case RSS14 = 'RSS14';
    case RSSEXPANDED = 'RSSEXPANDED';
    case UPCA = 'UPCA';
    case UPCE = 'UPCE';
}