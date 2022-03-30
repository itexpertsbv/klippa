<?php

namespace ITExperts\Klippa\ParsedDocument;

use ITExperts\Klippa\ParsedDocument\Barcode\Barcode;
use ITExperts\Klippa\ParsedDocument\Barcode\Type;
use ITExperts\Klippa\ParsedDocument\Enum\DocumentType;
use ITExperts\Klippa\ParsedDocument\Enum\InvoiceType;
use ITExperts\Klippa\ParsedDocument\Enum\PaymentMethod;
use ITExperts\Klippa\ParsedDocument\Enum\VatContext;
use ITExperts\Klippa\ParsedDocument\Line\Line;
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

    /**
     * @param array $data
     * @return static
     * @throws \Exception
     */
    public static function fromArray(array $data): self
    {
        $barcodes = self::extractBarcodes($data);
        $lines = self::extractLines($data);
        $vatItems = self::extractVatItems($data);

        $self = new self(
            $data['amount'],
            $data['amount_change'],
            $data['amount_shipping'],
            $data['amount_tip'],
            $data['amountexvat'],
            $barcodes,
            $data['currency'],
            $data['customer_address'],
            $data['customer_bank_account_number'],
            $data['customer_bank_account_number_bic'],
            $data['customer_city'],
            $data['customer_coc_number'],
            $data['customer_country'],
            $data['customer_email'],
            $data['customer_fiscal_number'],
            $data['customer_house_number'],
            $data['customer_municipality'],
            $data['customer_name'],
            $data['customer_number'],
            $data['customer_phone'],
            $data['customer_province'],
            $data['customer_reference'],
            $data['customer_street_name'],
            $data['customer_vat_number'],
            $data['customer_website'],
            $data['customer_zipcode'],
            $data['date'] ? new \DateTime($data['date']) : null,
            $data['date_of_arrival'] ? new \DateTime($data['date_of_arrival']) : null,
            $data['date_of_departure'] ? new \DateTime($data['date_of_departure']) : null,
            $data['document_language'],
            $data['document_subject'],
            $data['document_type'] ? DocumentType::from($data['document_type']) : null,
            $data['hash'],
            $data['hash_duplicate'],
            $data['invoice_number'],
            $data['invoice_type'] ? InvoiceType::from($data['invoice_type']) : null,
            $lines,
            $data['matched_project_code_id'],
            $data['matched_purchase_order_id'],
            $data['merchant_address'],
            $data['merchant_bank_account_number'],
            $data['merchant_bank_account_number_bic'],
            $data['merchant_bank_domestic_account_number'],
            $data['merchant_bank_domestic_bank_code'],
            $data['merchant_chain_liability_amount'],
            $data['merchant_chain_liability_bank_account_number'],
            $data['merchant_city'],
            $data['merchant_coc_number'],
            $data['merchant_country'],
            $data['merchant_country_code'],
            $data['merchant_email'],
            $data['merchant_fiscal_number'],
            $data['merchant_house_number'],
            $data['merchant_id'],
            $data['merchant_main_activity_code'],
            $data['merchant_municipality'],
            $data['merchant_name'],
            $data['merchant_phone'],
            $data['merchant_province'],
            $data['merchant_street_name'],
            $data['merchant_vat_number'],
            $data['merchant_website'],
            $data['merchant_zipcode'],
            $data['order_number'],
            $data['package_number'],
            $data['payment_auth_code'],
            $data['payment_card_account_number'],
            $data['payment_card_bank'],
            $data['payment_card_issuer'],
            $data['payment_card_number'],
            $data['payment_due_date'] ? new \DateTime($data['payment_due_date']) : null,
            $data['payment_slip_code'],
            $data['payment_slip_customer_number'],
            $data['payment_slip_reference_number'],
            $data['paymentmethod'] ? PaymentMethod::from($data['paymentmethod']) : null,
            $data['personal_income_tax_amount'],
            $data['personal_income_tax_rate'],
            $data['project_code'],
            $data['purchasedate'] ? new \DateTime($data['purchasedate']) : null,
            $data['purchasetime'],
            $data['raw_text'],
            $data['receipt_number'],
            $data['server'],
            $data['service_date'] ? new \DateTime($data['service_date']) : null,
            $data['shop_number'],
            $data['table_group'],
            $data['table_number'],
            $data['terminal_number'],
            $data['transaction_number'],
            $data['transaction_reference'],
            $data['vat_context'] ? VatContext::from($data['vat_context']) : null,
            $data['vatamount'],
            $vatItems,
            json_encode($data)
        );

        return $self;
    }

    /**
     * @param array $data
     * @return Lines[]
     */
    private static function extractLines(array $data): array
    {
        $lines = [];

        if ($data['lines'] && count($data['lines']) > 0) {
            foreach ($data['lines'] as $line) {
                $innerLines = [];
                foreach ($line['lineitems'] as $lineitem) {
                    $innerLines[] = new Line(
                        $lineitem['amount'],
                        $lineitem['amount_each'],
                        $lineitem['amount_ex_vat'],
                        $lineitem['description'],
                        $lineitem['quantity'],
                        $lineitem['sku'],
                        $lineitem['title'],
                        $lineitem['unit_of_measurement'],
                        $lineitem['vat_amount'],
                        $lineitem['vat_code'],
                        $lineitem['vat_percentage']
                    );
                }

                $lines[] = new Lines(
                    $line['description'],
                    $innerLines
                );
            }
        }

        return $lines;
    }

    /**
     * @param array $data
     * @return Barcode[]
     */
    private static function extractBarcodes(array $data): array
    {
        $barcodes = [];

        if ($data['barcodes'] && count($data['barcodes']) > 0) {
            foreach ($data['barcodes'] as $barcode) {
                $barcodes[] = new Barcode(
                    Type::from($barcode['type']),
                    $barcode['value']
                );
            }
        }

        return $barcodes;
    }

    /**
     * @param array $data
     * @return VatItem[]
     */
    private static function extractVatItems(array $data): array
    {
        $vatItems = [];

        if ($data['vatitems'] && count($data['vatitems']) > 0) {
            foreach ($data['vatitems'] as $vatitem) {
                $vatItems[] = new VatItem(
                    $vatitem['amount'],
                    $vatitem['amount_excl_vat'],
                    $vatitem['amount_incl_vat'],
                    $vatitem['amount_incl_excl_vat_estimated'],
                    $vatitem['percentage'],
                    $vatitem['code']
                );
            }
        }

        return $vatItems;
    }
}