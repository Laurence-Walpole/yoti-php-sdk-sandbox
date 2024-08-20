<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use PHPUnit\Framework\Assert;
use Yoti\DocScan\Constants;
use Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfig;
use Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistAdvancedCaCheckBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistAdvancedCaCheck
 */
class SandboxWatchlistAdvancedCaCheckTest extends TestCase
{
    /**
     * @test
     * @covers ::getConfig
     * @covers ::getType
     * @covers ::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistAdvancedCaCheckBuilder::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistAdvancedCaCheckBuilder::withConfig
     */
    public function builderShouldBuildWithoutAnySuppliedConfig(): void
    {
        $configMock = $this->createMock(SandboxWatchlistAdvancedCaConfig::class);
        $check = (new SandboxWatchlistAdvancedCaCheckBuilder())
            ->withConfig($configMock)
            ->build();

        Assert::assertEquals(Constants::WATCHLIST_ADVANCED_CA, $check->getType());
        Assert::assertInstanceOf(SandboxWatchlistAdvancedCaConfig::class, $check->getConfig());
    }
}
