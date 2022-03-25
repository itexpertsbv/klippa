# Klippa API

This is a PHP wrapper to easily work with the Klippa API. For now we only support parsing of financial documents.
In the future we will be adding the rest of the Klippa API.

More info at: https://custom-ocr.klippa.com/docs

## Installation
```bash
composer require itexpertsbv/klippa
```

## Usage
First you need to create a client with the an api key.

```php
Use ITExperts\Klippa\Klippa;
Use ITExperts\Klippa\Klippa\Client\HttpClient;

$key = 'MkKjVvfjG2wJ5WAW3kkqgiZlWW0zN7aq'; // Sample key

// Create directly from Klippa
$klippa = Klippa::HttpClient($key);

// Build your own client first
$client = new HttpClient($key);
$klippa = new Klippa($client);
```

Then you have 2 options, parse a document from its base64 content string or pass a url for Klippa to download the document.
```php
$base64 = base64_encode(file_get_contente('path/to/file.pdf'));
$document = $klippa->parseDocumentFromBase64($base64);

echo $document->invoiceNumber; // e.g. FT22-0234

$url = 'https://acme.com/invoice.pdf';
$document = $klippa->parseDocumentFromUrl($url);

echo $document->invoiceNumber; // e.g. FT22-0234
```

## MIT License
Copyright 2022 IT Experts BV

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.