<?php

declare(strict_types=1);

namespace Yoti\Sandbox\Test\Aml;

use Yoti\Sandbox\Aml\SandboxAddress;
use Yoti\Sandbox\Aml\SandboxProfile;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Aml\Profile
 */
class SandboxProfileTest extends TestCase
{
    private const SOME_GIVEN_NAMES = 'Edward Richard George';
    private const SOME_FAMILY_NAME = 'Heath';
    private const SOME_SSN = '1234';

    /**
     * @var SandboxProfile
     */
    private $amlProfile;

    /**
     * @var SandboxAddress
     */
    private $amlAddressMock;

    /**
     * Create test Aml Profile.
     */
    public function setup(): void
    {
        $this->amlAddressMock = $this->createMock(SandboxAddress::class);
        $this->amlAddressMock
            ->method('jsonSerialize')
            ->willReturn((object)['some' => 'address']);

        $this->amlProfile = new SandboxProfile(
            self::SOME_GIVEN_NAMES,
            self::SOME_FAMILY_NAME,
            $this->amlAddressMock,
            self::SOME_SSN
        );
    }

    /**
     * @covers ::__construct
     * @covers ::getGivenNames
     */
    public function testGetGivenNames()
    {
        $this->assertEquals(self::SOME_GIVEN_NAMES, $this->amlProfile->getGivenNames());
    }

    /**
     * @covers ::__construct
     * @covers ::getFamilyName
     */
    public function testGetFamilyName()
    {
        $this->assertEquals(self::SOME_FAMILY_NAME, $this->amlProfile->getFamilyName());
    }

    /**
     * @covers ::__construct
     * @covers ::getSsn
     */
    public function testGetSsn()
    {
        $this->assertEquals(self::SOME_SSN, $this->amlProfile->getSsn());
    }

    /**
     * @covers ::__construct
     * @covers ::getSsn
     */
    public function testGetSsnNull()
    {
        $amlProfile = new SandboxProfile(
            self::SOME_GIVEN_NAMES,
            self::SOME_FAMILY_NAME,
            $this->amlAddressMock
        );
        $this->assertNull($amlProfile->getSsn());
    }

    /**
     * @covers ::__construct
     * @covers ::getAmlAddress
     */
    public function testGetAmlAddress()
    {
        $this->assertSame($this->amlAddressMock, $this->amlProfile->getAmlAddress());
    }

    /**
     * @covers ::__construct
     * @covers ::jsonSerialize
     * @covers ::__toString
     */
    public function testJsonSerialize()
    {
        $expectedData = [
            'given_names' => self::SOME_GIVEN_NAMES,
            'family_name' => self::SOME_FAMILY_NAME,
            'ssn' => self::SOME_SSN,
            'address' => $this->amlAddressMock,
        ];

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedData),
            json_encode($this->amlProfile)
        );

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedData),
            (string) $this->amlProfile
        );
    }
}
