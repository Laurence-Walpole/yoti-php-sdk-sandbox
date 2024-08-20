<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheckBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheckBuilder
 */
class SandboxDocumentFaceMatchCheckBuilderTest extends TestCase
{
    /**
     * @test
     * @covers ::withManualCheckAlways
     * @covers ::setManualCheck
     * @covers ::build
     */
    public function shouldCorrectlyBuildSandboxDocumentFaceMatchCheck()
    {
        $result = (new SandboxDocumentFaceMatchCheckBuilder())
            ->withManualCheckAlways()
            ->build();

        $this->assertInstanceOf(SandboxDocumentFaceMatchCheck::class, $result);
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::jsonSerialize
     * @covers ::withManualCheckAlways
     * @covers ::setManualCheck
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::getType
     */
    public function shouldReturnTheCorrectValuesWhenManualCheckIsAlways()
    {
        $result = (new SandboxDocumentFaceMatchCheckBuilder())
            ->withManualCheckAlways()
            ->build();

        $expected = [
            'type' => 'ID_DOCUMENT_FACE_MATCH',
            'config' => [
                'manual_check' => 'ALWAYS',
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::jsonSerialize
     * @covers ::withManualCheckFallback
     * @covers ::setManualCheck
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::getType
     */
    public function shouldReturnTheCorrectValuesWhenManualCheckIsFallback()
    {
        $result = (new SandboxDocumentFaceMatchCheckBuilder())
            ->withManualCheckFallback()
            ->build();

        $expected = [
            'type' => 'ID_DOCUMENT_FACE_MATCH',
            'config' => [
                'manual_check' => 'FALLBACK',
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::jsonSerialize
     * @covers ::withManualCheckNever
     * @covers ::setManualCheck
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck::getType
     */
    public function shouldReturnTheCorrectValuesWhenManualCheckIsNever()
    {
        $result = (new SandboxDocumentFaceMatchCheckBuilder())
            ->withManualCheckNever()
            ->build();

        $expected = [
            'type' => 'ID_DOCUMENT_FACE_MATCH',
            'config' => [
                'manual_check' => 'NEVER',
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }
}
