<?php

namespace ITExperts\Klippa;

use ITExperts\Klippa\Client\Client;
use ITExperts\Klippa\Client\HttpClient;
use ITExperts\Klippa\Credits\CreditsResult;
use ITExperts\Klippa\ParsedDocument\Barcode\Barcode;
use ITExperts\Klippa\ParsedDocument\Barcode\Type;
use ITExperts\Klippa\ParsedDocument\Enum\DocumentType;
use ITExperts\Klippa\ParsedDocument\Enum\InvoiceType;
use ITExperts\Klippa\ParsedDocument\Enum\PaymentMethod;
use ITExperts\Klippa\ParsedDocument\Enum\VatContext;
use ITExperts\Klippa\ParsedDocument\Financial;
use ITExperts\Klippa\ParsedDocument\Line\Line;
use ITExperts\Klippa\ParsedDocument\Line\Lines;
use ITExperts\Klippa\ParsedDocument\VatItem;

class Klippa
{
    public function __construct(private Client $client){}

    /**
     * @return CreditsResult
     */
    public function credits(): CreditsResult
    {
        $result = $this->client->credits();

        return new CreditsResult(
            $result['UsedCredits'],
            $result['SpendableCredits'],
            $result['AvailableCredits'],
            $result['UsesCreditSystem']
        );
    }

    /**
     * @param string $base64Content
     * @return Financial
     */
    public function parseDocumentFromBase64(string $base64Content): Financial
    {
        $data = $this->client->parseDocumentFromBase64($base64Content);

        return $this->parseDocument($data);
    }

    /**
     * @param string $url
     * @return Financial
     */
    public function parseDocumentFromUrl(string $url): Financial
    {
        $data = $this->client->parseDocumentFromUrl($url);

        return $this->parseDocument($data);
    }

    /**
     * @param array $data
     * @return Financial
     * @throws ResponseCouldNotBeParsedException
     */
    private function parseDocument(array $data): Financial
    {
        try {
            $barcodes = $this->extractBarcodes($data);
            $lines = $this->extractLines($data);
            $vatItems = $this->extractVatItems($data);

            return new Financial(
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
            );
        } catch (\Throwable $e) {
            throw new ResponseCouldNotBeParsedException($e->getMessage(), $e->getCode());
        }
    }

    /**
     * @param array $data
     * @return Lines[]
     */
    private function extractLines(array $data): array
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
    private function extractBarcodes(array $data): array
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
    private function extractVatItems(array $data): array
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

    /**
     * @param string $key
     * @return static
     */
    public static function HttpClient(string $key): self
    {
        $client = new HttpClient($key);
        return new self($client);
    }
}