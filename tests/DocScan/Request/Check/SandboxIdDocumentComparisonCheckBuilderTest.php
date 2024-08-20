<?php

namespace Yoti\Test\DocScan\Session\Create\Check;

use Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheckBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheckBuilder
 */
class SandboxIdDocumentComparisonCheckBuilderTest extends TestCase
{
    private const ID_DOCUMENT_COMPARISON = 'ID_DOCUMENT_COMPARISON';

    /**
     * @test
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck::getType
     */
    public function shouldCreateSandboxIdDocumentComparisonCheckCorrectly()
    {
        $result = (new SandboxIdDocumentComparisonCheckBuilder())
            ->build();

        $this->assertInstanceOf(SandboxIdDocumentComparisonCheck::class, $result);
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck::jsonSerialize
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck::getType
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck::getConfig
     */
    public function shouldJsonEncodeCorrectly()
    {
        $result = (new SandboxIdDocumentComparisonCheckBuilder())
            ->build();

        $expected = [
            'type' => self::ID_DOCUMENT_COMPARISON,
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck::__toString
     */
    public function shouldCreateCorrectString()
    {
        $result = (new SandboxIdDocumentComparisonCheckBuilder())
            ->build();

        $expected = [
            'type' => self::ID_DOCUMENT_COMPARISON,
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $result->__toString());
    }
}
