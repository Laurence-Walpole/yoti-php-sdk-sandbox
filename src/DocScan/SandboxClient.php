<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan;

use Yoti\Constants;
use Yoti\Http\Payload;
use Yoti\Http\Request;
use Yoti\Http\RequestBuilder;
use Yoti\Sandbox\DocScan\Exception\SandboxDocScanException;
use Yoti\Util\Config;
use Yoti\Util\PemFile;

class SandboxClient
{

    private const SANDBOX_URL = Constants::API_BASE_URL . '/sandbox/idverify/v1';
    private const SESSION_RESPONSE_CONFIG_PATH = '/sessions/%s/response-config';
    private const APPLICATION_RESPONSE_CONFIG_PATH = '/apps/%s/response-config';

    /**
     * @var string
     */
    private $sdkId;

    /**
     * @var PemFile
     */
    private $pemFile;

    /**
     * @var Config
     */
    private $config;

    /**
     * SandboxClient constructor.
     * @param string $sdkId
     * @param string $pemFile
     * @param Config $config
     * @throws \Yoti\Exception\PemFileException
     */
    public function __construct(string $sdkId, string $pemFile, Config $config)
    {
        $this->sdkId = $sdkId;
        $this->pemFile = PemFile::resolveFromString($pemFile);
        $this->config = $config;
    }

    /**
     * @param string|null $sessionId
     * @param SandboxExpectation $expectation
     */
    public function setExpectationForSession(?string $sessionId, SandboxExpectation $expectation): void
    {
        $endpoint = sprintf(self::SESSION_RESPONSE_CONFIG_PATH, $sessionId);
        $this->makeRequest($endpoint, $expectation);
    }

    /**
     * @param string $endpoint
     * @param SandboxExpectation $expectation
     */
    private function makeRequest(string $endpoint, SandboxExpectation $expectation): void
    {
        $response = (new RequestBuilder($this->config))
            ->withBaseUrl($this->config->getApiUrl() ?? self::SANDBOX_URL)
            ->withEndpoint($endpoint)
            ->withMethod(Request::METHOD_PUT)
            ->withPemFile($this->pemFile)
            ->withPayload(Payload::fromJsonData($expectation))
            ->withQueryParam('sdkId', $this->sdkId)
            ->build()
            ->execute();

        $responseCode = $response->getStatusCode();
        if ($responseCode < 200 || $responseCode >= 300) {
            throw new SandboxDocScanException("Failed on status code: " . $responseCode);
        }
    }

    /**
     * @param SandboxExpectation $expectation
     */
    public function setExpectationForApplication(SandboxExpectation $expectation): void
    {
        $endpoint = sprintf(self::APPLICATION_RESPONSE_CONFIG_PATH, $this->sdkId);
        $this->makeRequest($endpoint, $expectation);
    }
}
