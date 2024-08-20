<?php

namespace Yoti\Sandbox\Test\DocScan\Request\Check;

use PHPUnit\Framework\Assert;
use Yoti\Sandbox\DocScan\SandboxConstants;
use Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfig;
use Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfig
 */
class SandboxWatchlistScreeningConfigTest extends TestCase
{
    /**
     * @var string
     */
    private const SOME_UNKNOWN_CATEGORY = 'SOME_UNKNOWN_CATEGORY';

    /**
     * @test
     * @covers ::getCategories
     */
    public function builderShouldBuildWithoutAnySuppliedCategories()
    {
        $result = (new SandboxWatchlistScreeningConfigBuilder())->build();

        Assert::assertEmpty($result->getCategories());
    }

    /**
     * @test
     * @covers ::getCategories
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withAdverseMediaCategory
     */
    public function builderShouldBuildWithAdverseMediaCategory()
    {
        $result = (new SandboxWatchlistScreeningConfigBuilder())
            ->withAdverseMediaCategory()
            ->build();

        Assert::assertCount(1, $result->getCategories());
        Assert::assertContains(SandboxConstants::ADVERSE_MEDIA, $result->getCategories());
    }

    /**
     * @test
     * @covers ::getCategories
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withSanctionsCategory
     */
    public function builderShouldBuildWithSanctionsCategory()
    {
        $result = (new SandboxWatchlistScreeningConfigBuilder())
            ->withSanctionsCategory()
            ->build();

        Assert::assertCount(1, $result->getCategories());
        Assert::assertContains(SandboxConstants::SANCTIONS, $result->getCategories());
    }

    /**
     * @test
     * @covers ::getCategories
     */
    public function builderShouldAllowMultipleCategoriesToBeAdded()
    {
        $result = (new SandboxWatchlistScreeningConfigBuilder())
            ->withSanctionsCategory()
            ->withAdverseMediaCategory()
            ->build();

        Assert::assertCount(2, $result->getCategories());
        Assert::assertContains(SandboxConstants::SANCTIONS, $result->getCategories());
        Assert::assertContains(SandboxConstants::ADVERSE_MEDIA, $result->getCategories());
    }

    /**
     * @test
     * @covers ::getCategories
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withAdverseMediaCategory
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withSanctionsCategory
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withCategory
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::build
     * @covers ::__construct
     */
    public function builderShouldNotAddCategoryMoreThanOnceEvenIfCalled()
    {
        $result = (new SandboxWatchlistScreeningConfigBuilder())
            ->withCategory(SandboxConstants::ADVERSE_MEDIA)
            ->withCategory(SandboxConstants::ADVERSE_MEDIA)
            ->withAdverseMediaCategory()
            ->withAdverseMediaCategory()
            ->build();

        Assert::assertCount(1, $result->getCategories());
        Assert::assertContains(SandboxConstants::ADVERSE_MEDIA, $result->getCategories());
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::build
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withCategory
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withSanctionsCategory
     * @covers \Yoti\Sandbox\DocScan\Request\Check\SandboxWatchlistScreeningConfigBuilder::withAdverseMediaCategory
     */
    public function builderShouldNotAllowNullCategory()
    {
        $this->expectException(\InvalidArgumentException::class);

        (new SandboxWatchlistScreeningConfigBuilder())
            ->withCategory('')
            ->build();
    }

    /**
     * @test
     * @covers ::getCategories
     */
    public function builderShouldAllowCategoryUnknownToTheSdk()
    {
        $result = (new SandboxWatchlistScreeningConfigBuilder())
            ->withCategory(self::SOME_UNKNOWN_CATEGORY)
            ->withAdverseMediaCategory()
            ->withSanctionsCategory()
            ->build();

        Assert::assertCount(3, $result->getCategories());
        Assert::assertContains(SandboxConstants::ADVERSE_MEDIA, $result->getCategories());
        Assert::assertContains(SandboxConstants::SANCTIONS, $result->getCategories());
        Assert::assertContains(self::SOME_UNKNOWN_CATEGORY, $result->getCategories());
    }

    /**
     * @test
     * @covers ::jsonSerialize
     */
    public function shouldJsonEncodeCorrectly()
    {
        $someCategories = [
            'SOME_NEW',
            'SOME_OLD'
        ];

        $result = new SandboxWatchlistScreeningConfig($someCategories);

        $expected = [
            'categories' => [
                'SOME_NEW',
                'SOME_OLD'
            ],
        ];

        $this->assertJsonStringEqualsJsonString(json_encode($expected), json_encode($result));
    }
}
