<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use PHPUnit\Framework\Assert;
use Yoti\Sandbox\DocScan\Request\Check\Advanced\SandboxExactMatchingStrategy;
use Yoti\Sandbox\DocScan\Request\Check\Advanced\SandboxSearchProfileSources;
use Yoti\Sandbox\DocScan\Request\Check\SandboxYotiAccountWatchlistAdvancedCaConfigBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxYotiAccountWatchlistAdvancedCaConfigBuilder
 */
class SandboxYotiAccountWatchlistAdvancedCaConfigTest extends TestCase
{
    private const SOME_REMOVE_DECEASED = true;
    private const SOME_SHARE_URL = false;

    /**
     * @test
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfigBuilder::withMatchingStrategy
     * @covers \Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfigBuilder::withSources
     * @covers \Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfigBuilder::withShareUrl
     * @covers \Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfigBuilder::withRemoveDeceased
     * @covers \Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfigBuilder::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfig::getType
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxYotiAccountWatchlistAdvancedCaConfig::getType
     */
    public function builderShouldBuildWithCorrectProperties(): void
    {
        $exactMatchingStrategy = new SandboxExactMatchingStrategy();
        $profileSource = new SandboxSearchProfileSources('some_string');

        $result = (new SandboxYotiAccountWatchlistAdvancedCaConfigBuilder())
            ->withRemoveDeceased(self::SOME_REMOVE_DECEASED)
            ->withShareUrl(self::SOME_SHARE_URL)
            ->withSources($profileSource)
            ->withMatchingStrategy($exactMatchingStrategy)
            ->build();

        Assert::assertNotNull($result);
        Assert::assertEquals(self::SOME_REMOVE_DECEASED, $result->getRemoveDeceased());
        Assert::assertEquals(self::SOME_SHARE_URL, $result->getShareUrl());
        Assert::assertEquals($profileSource, $result->getSources());
        Assert::assertEquals($exactMatchingStrategy, $result->getMatchingStrategy());
        Assert::assertEquals('WITH_YOTI_ACCOUNT', $result->getType());
    }
}
