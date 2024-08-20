<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheckBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheckBuilder
 */
class SandboxLivenessCheckBuilderTest extends TestCase
{
    private const SOME_LIVENESS_TYPE = 'someLivenessType';
    private const SOME_MAX_RETRIES = 3;
    private const NEVER = 'NEVER';

    /**
     * @test
     * @covers ::build
     * @covers ::forLivenessType
     * @covers ::withMaxRetries
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::__construct
     */
    public function shouldCorrectlyBuildSandboxLivenessCheck()
    {
        $result = (new SandboxLivenessCheckBuilder())
            ->forLivenessType(self::SOME_LIVENESS_TYPE)
            ->withMaxRetries(self::SOME_MAX_RETRIES)
            ->build();

        $this->assertInstanceOf(SandboxLivenessCheck::class, $result);
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::jsonSerialize
     * @covers ::forLivenessType
     * @covers ::withMaxRetries
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::__construct
     */
    public function shouldBuildWithCustomLivenessType()
    {
        $result = (new SandboxLivenessCheckBuilder())
            ->forLivenessType(self::SOME_LIVENESS_TYPE)
            ->withMaxRetries(self::SOME_MAX_RETRIES)
            ->build();

        $expected = [
            'type' => 'LIVENESS',
            'config' => [
                'liveness_type' => self::SOME_LIVENESS_TYPE,
                'max_retries' => self::SOME_MAX_RETRIES,
            ]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::jsonSerialize
     * @covers ::forZoomLiveness
     * @covers ::withMaxRetries
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::getType
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::getConfig
     */
    public function shouldBuildWithZoomLivenessType()
    {
        $result = (new SandboxLivenessCheckBuilder())
            ->forZoomLiveness()
            ->withMaxRetries(self::SOME_MAX_RETRIES)
            ->build();

        $expected = [
            'type' => 'LIVENESS',
            'config' => [
                'liveness_type' => 'ZOOM',
                'max_retries' => self::SOME_MAX_RETRIES,
            ]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::jsonSerialize
     * @covers ::forStaticLiveness
     * @covers ::withManualCheck
     * @covers ::withoutManualCheck
     * @covers ::withMaxRetries
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::getType
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck::getConfig
     */
    public function shouldBuildWithStaticLivenessType()
    {
        $result = (new SandboxLivenessCheckBuilder())
            ->forStaticLiveness()
            ->withMaxRetries(self::SOME_MAX_RETRIES)
            ->withoutManualCheck()
            ->build();

        $expected = [
            'type' => 'LIVENESS',
            'config' => [
                'liveness_type' => 'STATIC',
                'max_retries' => self::SOME_MAX_RETRIES,
                'manual_check' => self::NEVER,
            ]
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }
}
