<?php

declare(strict_types=1);

namespace Yoti\Sandbox\Test\Aml;

use ArgumentCountError;
use Psr\Http\Message\ResponseInterface;
use Yoti\Sandbox\Aml\SandboxResult;
use Yoti\Sandbox\Test\TestCase;
use Yoti\Sandbox\Test\TestData;
use Yoti\Util\Json;

/**
 * @coversDefaultClass \Yoti\Sandbox\Aml\SandboxResult
 */
class SandboxResultTest extends TestCase
{
    /**
     * @var \Yoti\Sandbox\Aml\SandboxResult
     */
    public $amlResult;

    public function setup(): void
    {
        $this->responseMock = $this->createMock(ResponseInterface::class);
        $this->amlResult = new SandboxResult(
            Json::decode(file_get_contents(TestData::AML_CHECK_RESULT_JSON)),
            $this->responseMock
        );
    }

    /**
     * @covers ::isOnPepList
     * @covers ::__construct
     * @covers ::setAttributes
     * @covers ::checkAttributes
     */
    public function testIsOnPepeList()
    {
        $this->assertTrue($this->amlResult->isOnPepList());
    }

    /**
     * @covers ::isOnFraudList
     * @covers ::__construct
     * @covers ::setAttributes
     * @covers ::checkAttributes
     */
    public function testIsOnFraudList()
    {
        $this->assertFalse($this->amlResult->isOnFraudList());
    }

    /**
     * @covers ::isOnWatchList
     * @covers ::__construct
     * @covers ::setAttributes
     * @covers ::checkAttributes
     */
    public function testIsOnWatchList()
    {
        $this->assertFalse($this->amlResult->isOnWatchList());
    }

    /**
     */
    public function testMissingAttributes()
    {
        $this->expectException(\Yoti\Sandbox\Exception\SandboxAmlException::class);
        $this->expectExceptionMessage('Missing attributes from the result: on_pep_list,on_watch_list,on_watch_list');

        new SandboxResult([], $this->responseMock);
    }

    /**
     */
    public function testTooFewArguments()
    {
        $this->expectException(ArgumentCountError::class);

        new SandboxResult([]);
    }

    /**
     * @covers ::__toString
     */
    public function testToString()
    {
        $this->assertJsonStringEqualsJsonString(
            file_get_contents(TestData::AML_CHECK_RESULT_JSON),
            (string) $this->amlResult
        );
    }
}
