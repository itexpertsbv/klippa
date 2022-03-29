<?php

namespace ITExperts\Klippa\ParsedDocument;

use ITExperts\Klippa\ParsedDocument\Barcode\Barcode;
use ITExperts\Klippa\ParsedDocument\Enum\DocumentType;
use ITExperts\Klippa\ParsedDocument\Enum\InvoiceType;
use ITExperts\Klippa\ParsedDocument\Enum\PaymentMethod;
use ITExperts\Klippa\ParsedDocument\Enum\VatContext;
use ITExperts\Klippa\ParsedDocument\Line\Lines;

class Financial
{
    /**
     * @param int|null $amount
     * @param int|null $amountChange
     * @param int|null $amountShipping
     * @param int|null $amountTip
     * @param int|null $amountexvat
     * @param Barcode[]|null $barcodes
     * @param string|null $currency
     * @param string|null $customerAddress
     * @param string|null $customerBankAccountNumber
     * @param string|null $customerBankAccountNumberBic
     * @param string|null $customerCity
     * @param string|null $customerCocNumber
     * @param string|null $customerCountry
     * @param string|null $customerEmail
     * @param string|null $customerFiscalNumber
     * @param string|null $customerHouseNumber
     * @param string|null $customerMunicipality
     * @param string|null $customerName
     * @param string|null $customerNumber
     * @param string|null $customerPhone
     * @param string|null $customerProvince
     * @param string|null $customerReference
     * @param string|null $customerStreetName
     * @param string|null $customerVatNumber
     * @param string|null $customerWebsite
     * @param string|null $customerZipcode
     * @param \DateTime|null $date
     * @param \DateTime|null $dateOfArrival
     * @param \DateTime|null $dateOfDeparture
     * @param string|null $documentLanguage
     * @param string|null $documentSubject
     * @param DocumentType|null $documentType
     * @param string|null $hash
     * @param bool|null $hashDuplicate
     * @param string|null $invoiceNumber
     * @param InvoiceType|null $invoiceType
     * @param Lines[]|null $lines
     * @param string|null $matchedProjectCodeId
     * @param string|null $matchedPurchaseOrderId
     * @param string|null $merchantAddress
     * @param string|null $merchantBankAccountNumber
     * @param string|null $merchantBankAccountNumberBic
     * @param string|null $merchantBankDomesticAccountNumber
     * @param string|null $merchantBankDomesticBankCode
     * @param int|null $merchantChainLiabilityAmount
     * @param string|null $merchantChainLiabilityBankAccountNumber
     * @param string|null $merchantCity
     * @param string|null $merchantCocNumber
     * @param string|null $merchantCountry
     * @param string|null $merchantCountryCode
     * @param string|null $merchantEmail
     * @param string|null $merchantFiscalNumber
     * @param string|null $merchantHouseNumber
     * @param string|null $merchantId
     * @param string|null $merchantMainActivityCode
     * @param string|null $merchantMunicipality
     * @param string|null $merchantName
     * @param string|null $merchantPhone
     * @param string|null $merchantProvince
     * @param string|null $merchantStreetName
     * @param string|null $merchantVatNumber
     * @param string|null $merchantWebsite
     * @param string|null $merchantZipcode
     * @param string|null $orderNumber
     * @param string|null $packageNumber
     * @param string|null $paymentAuthCode
     * @param string|null $paymentCardAccountNumber
     * @param string|null $paymentCardBank
     * @param string|null $paymentCardIssuer
     * @param string|null $paymentCardNumber
     * @param \DateTime|null $paymentDueDate
     * @param string|null $paymentSlipCode
     * @param string|null $paymentSlipCustomerNumber
     * @param string|null $paymentSlipReferenceNumber
     * @param PaymentMethod|null $paymentmethod
     * @param int|null $personalIncomeTaxAmount
     * @param int|null $personalIncomeTaxRate
     * @param string|null $projectCode
     * @param \DateTime|null $purchasedate
     * @param string|null $purchasetime
     * @param string|null $rawText
     * @param string|null $receiptNumber
     * @param string|null $server
     * @param \DateTime|null $serviceDate
     * @param string|null $shopNumber
     * @param string|null $tableGroup
     * @param string|null $tableNumber
     * @param string|null $terminalNumber
     * @param string|null $transactionNumber
     * @param string|null $transactionReference
     * @param VatContext|null $vatContext
     * @param int|null $vatamount
     * @param VatItem[]|null $vatitems
     * @param string|null $data
     */
    public function __construct(
        readonly public ?int $amount,
        readonly public ?int $amountChange,
        readonly public ?int $amountShipping,
        readonly public ?int $amountTip,
        readonly public ?int $amountexvat,
        readonly public ?array $barcodes,
        readonly public ?string $currency,
        readonly public ?string $customerAddress,
        readonly public ?string $customerBankAccountNumber,
        readonly public ?string $customerBankAccountNumberBic,
        readonly public ?string $customerCity,
        readonly public ?string $customerCocNumber,
        readonly public ?string $customerCountry,
        readonly public ?string $customerEmail,
        readonly public ?string $customerFiscalNumber,
        readonly public ?string $customerHouseNumber,
        readonly public ?string $customerMunicipality,
        readonly public ?string $customerName,
        readonly public ?string $customerNumber,
        readonly public ?string $customerPhone,
        readonly public ?string $customerProvince,
        readonly public ?string $customerReference,
        readonly public ?string $customerStreetName,
        readonly public ?string $customerVatNumber,
        readonly public ?string $customerWebsite,
        readonly public ?string $customerZipcode,
        readonly public ?\DateTime $date,
        readonly public ?\DateTime $dateOfArrival,
        readonly public ?\DateTime $dateOfDeparture,
        readonly public ?string $documentLanguage,
        readonly public ?string $documentSubject,
        readonly public ?DocumentType $documentType,
        readonly public ?string $hash,
        readonly public ?bool $hashDuplicate,
        readonly public ?string $invoiceNumber,
        readonly public ?InvoiceType $invoiceType,
        readonly public ?array $lines,
        readonly public ?string $matchedProjectCodeId,
        readonly public ?string $matchedPurchaseOrderId,
        readonly public ?string $merchantAddress,
        readonly public ?string $merchantBankAccountNumber,
        readonly public ?string $merchantBankAccountNumberBic,
        readonly public ?string $merchantBankDomesticAccountNumber,
        readonly public ?string $merchantBankDomesticBankCode,
        readonly public ?int $merchantChainLiabilityAmount,
        readonly public ?string $merchantChainLiabilityBankAccountNumber,
        readonly public ?string $merchantCity,
        readonly public ?string $merchantCocNumber,
        readonly public ?string $merchantCountry,
        readonly public ?string $merchantCountryCode,
        readonly public ?string $merchantEmail,
        readonly public ?string $merchantFiscalNumber,
        readonly public ?string $merchantHouseNumber,
        readonly public ?string $merchantId,
        readonly public ?string $merchantMainActivityCode,
        readonly public ?string $merchantMunicipality,
        readonly public ?string $merchantName,
        readonly public ?string $merchantPhone,
        readonly public ?string $merchantProvince,
        readonly public ?string $merchantStreetName,
        readonly public ?string $merchantVatNumber,
        readonly public ?string $merchantWebsite,
        readonly public ?string $merchantZipcode,
        readonly public ?string $orderNumber,
        readonly public ?string $packageNumber,
        readonly public ?string $paymentAuthCode,
        readonly public ?string $paymentCardAccountNumber,
        readonly public ?string $paymentCardBank,
        readonly public ?string $paymentCardIssuer,
        readonly public ?string $paymentCardNumber,
        readonly public ?\DateTime $paymentDueDate,
        readonly public ?string $paymentSlipCode,
        readonly public ?string $paymentSlipCustomerNumber,
        readonly public ?string $paymentSlipReferenceNumber,
        readonly public ?PaymentMethod $paymentmethod,
        readonly public ?int $personalIncomeTaxAmount,
        readonly public ?int $personalIncomeTaxRate,
        readonly public ?string $projectCode,
        readonly public ?\DateTime $purchasedate,
        readonly public ?string $purchasetime,
        readonly public ?string $rawText,
        readonly public ?string $receiptNumber,
        readonly public ?string $server,
        readonly public ?\DateTime $serviceDate,
        readonly public ?string $shopNumber,
        readonly public ?string $tableGroup,
        readonly public ?string $tableNumber,
        readonly public ?string $terminalNumber,
        readonly public ?string $transactionNumber,
        readonly public ?string $transactionReference,
        readonly public ?VatContext $vatContext,
        readonly public ?int $vatamount,
        readonly public ?array $vatitems,
        readonly public ?string $data
    ){}
}