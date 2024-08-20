<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheckBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheckBuilder
 */
class SandboxFaceComparisonCheckBuilderTest extends TestCase
{
    /**
     * @test
     * @covers ::withManualCheckAlways
     * @covers ::setManualCheck
     * @covers ::build
     */
    public function shouldCorrectlyBuildSandboxFaceMatchCheck()
    {
        $result = (new SandboxFaceComparisonCheckBuilder())
            ->withManualCheckNever()
            ->build();

        $this->assertInstanceOf(SandboxFaceComparisonCheck::class, $result);
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheck::jsonSerialize
     * @covers ::withManualCheckNever
     * @covers ::setManualCheck
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheck::getConfig
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxFaceComparisonCheck::getType
     */
    public function shouldReturnTheCorrectValuesWhenManualCheckIsNever()
    {
        $result = (new SandboxFaceComparisonCheckBuilder())
            ->withManualCheckNever()
            ->build();

        $expected = [
            'type' => 'FACE_COMPARISON',
            'config' => [
                'manual_check' => 'NEVER',
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }
}
