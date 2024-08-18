<?php

declare(strict_types=1);

namespace Yoti\Sandbox\Test;

class TestData
{
    public const SDK_ID = '990a3996-5762-4e8a-aa64-cb406fdb0e68';
    public const PEM_FILE = __DIR__ . '/sample-data/test.pem';
    public const AML_CHECK_RESULT_JSON = __DIR__ . '/sample-data/aml-check-result.json';
    public const AML_PRIVATE_KEY = __DIR__ . '/sample-data/aml-check-private-key.pem';
    public const AML_PUBLIC_KEY = __DIR__ . '/sample-data/aml-check-public-key.pem';
    public const CONNECT_BASE_URL = 'https://api.yoti.com/api/v1';
}
