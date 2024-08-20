<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheckConfig;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheckConfig
 */
class SandboxFaceComparisonCheckConfigTest extends TestCase
{
    private const SOME_MANUAL_CHECK = 'someManualCheck';

    /**
     * @test
     * @covers ::__construct
     * @covers ::getManualCheck
     */
    public function shouldHoldValuesCorrectly()
    {
        $result = new SandboxFaceComparisonCheckConfig(self::SOME_MANUAL_CHECK);

        $this->assertEquals(self::SOME_MANUAL_CHECK, $result->getManualCheck());
    }

    /**
     * @test
     * @covers ::jsonSerialize
     */
    public function shouldSerializeToJsonCorrectly()
    {
        $result = new SandboxFaceComparisonCheckConfig(self::SOME_MANUAL_CHECK);

        $expected = [
            'manual_check' => self::SOME_MANUAL_CHECK,
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }
}
