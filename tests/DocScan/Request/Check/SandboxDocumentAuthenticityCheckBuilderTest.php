<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheckBuilder;
use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheckConfig;
use Yoti\Sandbox\DocScan\Request\Filters\SandboxDocumentFilter;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheckBuilder
 */
class SandboxDocumentAuthenticityCheckBuilderTest extends TestCase
{
    /**
     * @test
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\RequestedDocumentAuthenticityCheck::getType
     */
    public function shouldCreateRequestedDocumentAuthenticityCheckCorrectly()
    {
        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->build();

        $this->assertInstanceOf(SandboxDocumentAuthenticityCheck::class, $result);
    }

    /**
     * @test
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::jsonSerialize
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::getType
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::getConfig
     */
    public function shouldJsonEncodeCorrectly()
    {
        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->build();

        $expected = [
            'config' => (object)[],
            'type' => 'ID_DOCUMENT_AUTHENTICITY',
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::__toString
     */
    public function shouldCreateCorrectString()
    {
        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->build();

        $expected = [
            'config' => (object)[],
            'type' => 'ID_DOCUMENT_AUTHENTICITY',
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $result->__toString());
    }

    /**
     * @test
     * @covers ::withManualCheckAlways
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::__construct
     */
    public function shouldJsonEncodeCorrectlyWithManualCheckAlways()
    {
        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->withManualCheckAlways()
            ->build();

        $expected = [
            'config' => (object)[
                'manual_check' => 'ALWAYS',
            ],
            'type' => 'ID_DOCUMENT_AUTHENTICITY',
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers ::withManualCheckNever
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::__construct
     */
    public function shouldJsonEncodeCorrectlyWithManualCheckNever()
    {
        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->withManualCheckNever()
            ->build();

        $expected = [
            'config' => (object)[
                'manual_check' => 'NEVER',
            ],
            'type' => 'ID_DOCUMENT_AUTHENTICITY',
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers ::withManualCheckFallback
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::__construct
     */
    public function shouldJsonEncodeCorrectlyWithManualCheckFallback()
    {
        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->withManualCheckFallback()
            ->build();

        $expected = [
            'config' => (object)[
                'manual_check' => 'FALLBACK',
            ],
            'type' => 'ID_DOCUMENT_AUTHENTICITY',
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers ::withIssuingAuthoritySubCheck
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheckConfig::getIssuingAuthoritySubCheck
     */
    public function withIssuingAuthoritySubCheckShouldBuildDefaultObject()
    {
        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->withIssuingAuthoritySubCheck()
            ->build();

        /** @var SandboxDocumentAuthenticityCheckConfig $config */
        $config = $result->getConfig();

        $this->assertTrue($config->getIssuingAuthoritySubCheck()->isRequested());
        $this->assertNull($config->getIssuingAuthoritySubCheck()->getFilter());
    }

    /**
     * @test
     * @covers ::withIssuingAuthoritySubCheckAndDocumentFilter
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheckConfig::getIssuingAuthoritySubCheck
     */
    public function withIssuingAuthoritySubCheckShouldAcceptDocumentFilter()
    {
        $documentFilterMock = $this->getMockForAbstractClass(SandboxDocumentFilter::class, ['type']);

        $result = (new SandboxDocumentAuthenticityCheckBuilder())
            ->withIssuingAuthoritySubCheckAndDocumentFilter($documentFilterMock)
            ->build();

        /** @var SandboxDocumentAuthenticityCheckConfig $config */
        $config = $result->getConfig();

        $this->assertTrue($config->getIssuingAuthoritySubCheck()->isRequested());
        $this->assertInstanceOf(SandboxDocumentFilter::class, $config->getIssuingAuthoritySubCheck()->getFilter());
    }
}
