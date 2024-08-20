<?php

namespace Yoti\Test\DocScan\Session\Create\Check;

use Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheckBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\RequestedThirdPartyIdentityCheckBuilder
 */
class SandboxThirdPartyIdentityCheckBuilderTest extends TestCase
{
    private const THIRD_PARTY_IDENTITY = 'THIRD_PARTY_IDENTITY';

    /**
     * @test
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck::getType
     */
    public function shouldCreateSandboxThirdPartyIdentityCheckCorrectly()
    {
        $result = (new SandboxThirdPartyIdentityCheckBuilder())
            ->build();

        $this->assertInstanceOf(SandboxThirdPartyIdentityCheck::class, $result);
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck::jsonSerialize
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck::getType
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck::getConfig
     */
    public function shouldJsonEncodeCorrectly()
    {
        $result = (new SandboxThirdPartyIdentityCheckBuilder())
            ->build();

        $expected = [
            'type' => self::THIRD_PARTY_IDENTITY,
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck::__toString
     */
    public function shouldCreateCorrectString()
    {
        $result = (new SandboxThirdPartyIdentityCheckBuilder())
            ->build();

        $expected = [
            'type' => self::THIRD_PARTY_IDENTITY,
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), $result->__toString());
    }
}
