<?php

declare(strict_types=1);

namespace Yoti\Sandbox\Test\Aml;

use Yoti\Sandbox\Aml\SandboxAddress;
use Yoti\Sandbox\Aml\SandboxCountry;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Aml\Address
 */
class SandboxAddressTest extends TestCase
{
    private const SOME_POSTCODE = 'BN2 1TW';
    private const SOME_COUNTRY_CODE = 'GBR';

    /**
     * @var Country
     */
    private $countryMock;

    public function setup(): void
    {
        $this->countryMock = $this->createMock(SandboxCountry::class);
        $this->countryMock
            ->method('jsonSerialize')
            ->willReturn(self::SOME_COUNTRY_CODE);
    }

    /**
     * @covers ::__construct
     * @covers ::getCountry
     */
    public function testGetCountry()
    {
        $amlAddress = new SandboxAddress($this->countryMock);

        $this->assertEquals($this->countryMock, $amlAddress->getCountry());
    }

    /**
     * @covers ::__construct
     * @covers ::getPostcode
     */
    public function testGetPostcode()
    {
        $amlAddress = new SandboxAddress(
            $this->countryMock,
            self::SOME_POSTCODE
        );

        $this->assertEquals(self::SOME_POSTCODE, $amlAddress->getPostcode());
    }

    /**
     * @covers ::__construct
     * @covers ::getPostcode
     */
    public function testGetPostcodeNull()
    {
        $amlAddress = new SandboxAddress($this->countryMock);

        $this->assertNull($amlAddress->getPostcode());
    }

    /**
     * @covers ::jsonSerialize
     * @covers ::__toString
     */
    public function testJsonSerialize()
    {
        $amlAddress = new SandboxAddress($this->countryMock, self::SOME_POSTCODE);

        $expectedData = (object)[
            'post_code' => self::SOME_POSTCODE,
            'country' => $this->countryMock,
        ];

        $this->assertEquals($expectedData, $amlAddress->jsonSerialize());

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedData),
            json_encode($amlAddress)
        );

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedData),
            (string) $amlAddress
        );
    }
}
