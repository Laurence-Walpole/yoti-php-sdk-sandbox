<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use PHPUnit\Framework\Assert;
use Yoti\DocScan\Constants;
use Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningCheckBuilder;
use Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\RequestedWatchlistScreeningCheck
 */
class SandboxWatchlistScreeningCheckTest extends TestCase
{
    /**
     * @test
     * @covers ::getConfig
     * @covers ::getType
     */
    public function builderShouldBuildWithoutAnySuppliedConfig(): void
    {
        $check = (new SandboxWatchlistScreeningCheckBuilder())->build();

        Assert::assertEquals(Constants::WATCHLIST_SCREENING, $check->getType());
        Assert::assertNull($check->getConfig());
    }

    /**
     * @test
     * @covers ::getConfig
     * @covers ::__construct
     * @covers ::getType
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningCheckBuilder::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningCheckBuilder::withConfig
     */
    public function builderShouldBuildWithSuppliedConfig(): void
    {
        $config = (new SandboxWatchlistScreeningConfigBuilder())->build();
        $check = (new SandboxWatchlistScreeningCheckBuilder())
            ->withConfig($config)
            ->build();

        Assert::assertEquals(Constants::WATCHLIST_SCREENING, $check->getType());
        Assert::assertEquals($config, $check->getConfig());
    }
}
