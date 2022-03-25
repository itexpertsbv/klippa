<?php

namespace Tests\ITExperts\Klippa;

use ITExperts\Klippa\Client\JsonDecodeFailedException;
use ITExperts\Klippa\Client\RequestFailedException;
use ITExperts\Klippa\Klippa;
use ITExperts\Klippa\ParsedDocument\Barcode\Type;
use ITExperts\Klippa\ParsedDocument\Enum\DocumentType;
use ITExperts\Klippa\ParsedDocument\Enum\InvoiceType;
use ITExperts\Klippa\ParsedDocument\Enum\PaymentMethod;
use ITExperts\Klippa\ParsedDocument\Enum\VatContext;
use ITExperts\Klippa\ParsedDocument\Financial;
use ITExperts\Klippa\ResponseCouldNotBeParsedException;
use PHPUnit\Framework\TestCase;

class KlippaTest extends TestCase
{
    private Klippa $klippa;

    public function setUp(): void
    {
        $client = new InMemoryClient();
        $this->klippa = new Klippa($client);
    }

    public function testItCanRequestCredits(): void
    {
        $credits = $this->klippa->credits();

        $this->assertSame(50, $credits->available);
        $this->assertSame(44, $credits->spendable);
        $this->assertSame(6, $credits->used);
        $this->assertTrue($credits->usesCredits);
    }

    public function testItCanScanDocumentFromBase64(): void
    {
        $document = $this->klippa->parseDocumentFromBase64('foo');
        $this->assertDocument($document);
    }

    public function testItCanScanDocumentFromUrl(): void
    {
        $document = $this->klippa->parseDocumentFromUrl('https://some.url');
        $this->assertDocument($document);
    }

    public function testItCanHandleInvalidResponse(): void
    {
        $client = new FailingClient();
        $klippa = new Klippa($client);

        $this->expectException(JsonDecodeFailedException::class);

        $klippa->credits();
    }

    public function testItCanHandleServerErrorResponse(): void
    {
        $client = new FailingClient();
        $klippa = new Klippa($client);

        $this->expectException(RequestFailedException::class);
        $this->expectExceptionMessage('server fault');

        $klippa->parseDocumentFromBase64('');
    }

    public function testItCanHandleInvalidPayload(): void
    {
        $client = new FailingClient();
        $klippa = new Klippa($client);

        $this->expectException(ResponseCouldNotBeParsedException::class);
        $this->expectExceptionMessage('Undefined array key "barcodes"');

        $klippa->parseDocumentFromUrl('');
    }

    private function assertDocument(Financial $document): void
    {
        $this->assertSame(23850, $document->amount);
        $this->assertSame(0, $document->amountChange);
        $this->assertSame(0, $document->amountShipping);
        $this->assertSame(0, $document->amountTip);
        $this->assertSame(23850, $document->amountexvat);
        $this->assertCount(1, $document->barcodes);
        $this->assertSame(Type::EAN13, $document->barcodes[0]->type);
        $this->assertSame("2839871564278", $document->barcodes[0]->barcode);
        $this->assertSame('EUR', $document->currency);
        $this->assertSame('Leopoldlaan 41', $document->customerAddress);
        $this->assertSame('BE35897972576137', $document->customerBankAccountNumber);
        $this->assertSame('VDSPBE91', $document->customerBankAccountNumberBic);
        $this->assertSame('Eeklo', $document->customerCity);
        $this->assertSame('892718912', $document->customerCocNumber);
        $this->assertSame('BE', $document->customerCountry);
        $this->assertSame('info@itexperts.be', $document->customerEmail);
        $this->assertSame('892718912', $document->customerFiscalNumber);
        $this->assertSame('41', $document->customerHouseNumber);
        $this->assertSame('Eeklo', $document->customerMunicipality);
        $this->assertSame('It Experts BVBA', $document->customerName);
        $this->assertSame('512346', $document->customerNumber);
        $this->assertSame('+3293950404', $document->customerPhone);
        $this->assertSame('Oost Vlaanderen', $document->customerProvince);
        $this->assertSame('REF123', $document->customerReference);
        $this->assertSame('Leopoldlaan', $document->customerStreetName);
        $this->assertSame('BE0892718912', $document->customerVatNumber);
        $this->assertSame('https://www.itexperts.be', $document->customerWebsite);
        $this->assertSame('9900', $document->customerZipcode);
        $this->assertSame((new \DateTime('2022-03-15'))->getTimestamp(), $document->date->getTimestamp());
        $this->assertSame((new \DateTime('2022-03-14'))->getTimestamp(), $document->dateOfArrival->getTimestamp());
        $this->assertSame((new \DateTime('2022-03-13'))->getTimestamp(), $document->dateOfDeparture->getTimestamp());
        $this->assertSame('NL', $document->documentLanguage);
        $this->assertSame('Subject', $document->documentSubject);
        $this->assertSame(DocumentType::INVOICE, $document->documentType);
        $this->assertSame('59086f65ea7f6c72295190093b55184ad6cca3b6', $document->hash);
        $this->assertFalse($document->hashDuplicate);
        $this->assertSame('F0000.2203.0012.8054', $document->invoiceNumber);
        $this->assertSame(InvoiceType::INVOICE, $document->invoiceType);

        $this->assertCount(1, $document->lines);
        $lines = $document->lines[0];

        $this->assertSame('description', $lines->description);
        $this->assertCount(11, $lines->lines);

        $innerLine = $lines->lines[0];
        $this->assertSame('BladeVPS PureSSD B4 (itexperts-vps5) (webserver04) Maandelijks 04-03-2022 03-04-2022', $innerLine->title);
        $this->assertSame('Inner description', $innerLine->description);
        $this->assertSame(2800, $innerLine->amount);
        $this->assertSame(2800, $innerLine->amountEach);
        $this->assertSame(2800, $innerLine->amountExVat);
        $this->assertSame(0, $innerLine->vatAmount);
        $this->assertSame(0, $innerLine->vatPercentage);
        $this->assertSame(1.0, $innerLine->quantity);
        $this->assertSame('pc', $innerLine->unitOfMeasurement);
        $this->assertSame('SKU123', $innerLine->sku);
        $this->assertSame('S', $innerLine->vatCode);

        $this->assertSame('PCI123', $document->matchedProjectCodeId);
        $this->assertSame('POI123', $document->matchedPurchaseOrderId);
        $this->assertSame('Vondellaan 47', $document->merchantAddress);
        $this->assertSame('NL07ABNA1390722899', $document->merchantBankAccountNumber);
        $this->assertSame('ABNANL2A', $document->merchantBankAccountNumberBic);
        $this->assertSame('NL07ABNA1390722899', $document->merchantBankDomesticAccountNumber);
        $this->assertSame('DMC123', $document->merchantBankDomesticBankCode);
        $this->assertSame(100, $document->merchantChainLiabilityAmount);
        $this->assertSame('NL07ABNA1390722899', $document->merchantChainLiabilityBankAccountNumber);
        $this->assertSame('Leiden', $document->merchantCity);
        $this->assertSame('24345899', $document->merchantCocNumber);
        $this->assertSame('Netherlands', $document->merchantCountry);
        $this->assertSame('NL', $document->merchantCountryCode);
        $this->assertSame('support@transip.nl', $document->merchantEmail);
        $this->assertSame('NL812334966B01', $document->merchantFiscalNumber);
        $this->assertSame('47', $document->merchantHouseNumber);
        $this->assertSame('MID123', $document->merchantId);
        $this->assertSame('MMAC123', $document->merchantMainActivityCode);
        $this->assertSame('Leiden', $document->merchantMunicipality);
        $this->assertSame('TransIP', $document->merchantName);
        $this->assertSame('+31107853369', $document->merchantPhone);
        $this->assertSame('Zuid Holland', $document->merchantProvince);
        $this->assertSame('Vondellaan', $document->merchantStreetName);
        $this->assertSame('NL812334966B01', $document->merchantVatNumber);
        $this->assertSame('http://www.transip.be', $document->merchantWebsite);
        $this->assertSame('2332 AA', $document->merchantZipcode);
        $this->assertSame('ON123', $document->orderNumber);
        $this->assertSame('PN123', $document->packageNumber);
        $this->assertSame('PAC123', $document->paymentAuthCode);
        $this->assertSame('PCAN123', $document->paymentCardAccountNumber);
        $this->assertSame('PCB123', $document->paymentCardBank);
        $this->assertSame('Visa', $document->paymentCardIssuer);
        $this->assertSame('PCN123', $document->paymentCardNumber);
        $this->assertSame((new \DateTime('2022-03-31T00:00:00'))->getTimestamp(), $document->paymentDueDate->getTimestamp());
        $this->assertSame('PSC123', $document->paymentSlipCode);
        $this->assertSame('PSCN123', $document->paymentSlipCustomerNumber);
        $this->assertSame('PSRN123', $document->paymentSlipReferenceNumber);
        $this->assertSame(PaymentMethod::BANK, $document->paymentmethod);
        $this->assertSame(0, $document->personalIncomeTaxAmount);
        $this->assertSame(0, $document->personalIncomeTaxRate);
        $this->assertSame('PC123', $document->projectCode);
        $this->assertSame((new \DateTime('2022-03-15'))->getTimestamp(), $document->purchasedate->getTimestamp());
        $this->assertSame('00:00:00', $document->purchasetime);
        $this->assertSame('rawtext', $document->rawText);
        $this->assertSame('F0000.2203.0012.8054', $document->receiptNumber);
        $this->assertSame('S123', $document->server);
        $this->assertSame((new \DateTime('2022-03-12T00:00:00'))->getTimestamp(), $document->serviceDate->getTimestamp());
        $this->assertSame('SN123', $document->shopNumber);
        $this->assertSame('TG123', $document->tableGroup);
        $this->assertSame('TN123', $document->tableNumber);
        $this->assertSame('TN123', $document->terminalNumber);
        $this->assertSame('TXN123', $document->transactionNumber);
        $this->assertSame('TXR123', $document->transactionReference);
        $this->assertSame(VatContext::VAT_REVERSE_CHARGE, $document->vatContext);
        $this->assertSame(0, $document->vatamount);
        $this->assertCount(1, $document->vatitems);
        $this->assertSame(10, $document->vatitems[0]->amount);
        $this->assertSame(10, $document->vatitems[0]->amount_excl_vat);
        $this->assertSame(10, $document->vatitems[0]->amount_incl_vat);
        $this->assertTrue($document->vatitems[0]->amount_incl_excl_vat_estimated);
        $this->assertSame('S', $document->vatitems[0]->code);
        $this->assertSame(0, $document->vatitems[0]->percentage);
    }
}