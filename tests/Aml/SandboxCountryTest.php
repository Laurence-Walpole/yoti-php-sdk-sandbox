<?php

declare(strict_types=1);

namespace Yoti\Sandbox\Test\Aml;

use Yoti\Sandbox\Aml\SandboxCountry;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\Aml\SandboxCountry
 */
class SandboxCountryTest extends TestCase
{
    private const SOME_COUNTRY_CODE = 'GBR';

    /**
     * @var SandboxCountry
     */
    private $country;

    public function setup(): void
    {
        $this->country = new SandboxCountry(self::SOME_COUNTRY_CODE);
    }

    /**
     * @covers ::__construct
     * @covers ::getCode
     */
    public function testGetCode()
    {
        $this->assertEquals(
            self::SOME_COUNTRY_CODE,
            $this->country->getCode()
        );
    }

    /**
     * @covers ::jsonSerialize
     */
    public function testJsonSerialize()
    {
        $this->assertJsonStringEqualsJsonString(
            json_encode(self::SOME_COUNTRY_CODE),
            json_encode($this->country)
        );
    }
}
