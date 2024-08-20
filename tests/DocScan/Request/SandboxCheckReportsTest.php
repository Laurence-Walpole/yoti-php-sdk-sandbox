<?php

declare(strict_types=1);

namespace Yoti\Sandbox\Test\DocScan\Request;

use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentTextDataCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck;
use Yoti\Sandbox\DocScan\Request\SandboxCheckReports;
use Yoti\Sandbox\DocScan\Request\SandboxCheckReportsBuilder;
use Yoti\Sandbox\Test\TestCase;

/**
 * @coversDefaultClass \Yoti\Sandbox\DocScan\Request\SandboxCheckReportsBuilder
 */

class SandboxCheckReportsTest extends TestCase
{
    private const SOME_ASYNC_REPORT_DELAY = 30;

    /**
     * @var SandboxDocumentTextDataCheck
     */
    private $documentTextDataCheckMock;

    /**
     * @var SandboxDocumentAuthenticityCheck
     */
    private $documentAuthenticityCheckMock;

    /**
     * @var SandboxDocumentFaceMatchCheck
     */
    private $documentFaceMatchCheckMock;

    /**
     * @var SandboxLivenessCheck
     */
    private $livenessCheckMock;

    /**
     * @var SandboxIdDocumentComparisonCheck
     */
    private $idDocumentComparisonCheckMock;

    /**
     * @var SandboxThirdPartyIdentityCheck
     */
    private $thirdPartyIdentityCheckMock;

    public function setup(): void
    {
        $this->documentAuthenticityCheckMock = $this->createMock(SandboxDocumentAuthenticityCheck::class);
        $this->documentAuthenticityCheckMock
            ->method('jsonSerialize')
            ->willReturn((object) [ 'type' => 'documentAuthenticityCheck' ]);

        $this->documentFaceMatchCheckMock = $this->createMock(SandboxDocumentFaceMatchCheck::class);
        $this->documentFaceMatchCheckMock
            ->method('jsonSerialize')
            ->willReturn((object) [ 'type' => 'documentFaceMatchCheck' ]);

        $this->livenessCheckMock = $this->createMock(SandboxLivenessCheck::class);
        $this->livenessCheckMock
            ->method('jsonSerialize')
            ->willReturn((object) [ 'type' => 'livenessCheck' ]);

        $this->idDocumentComparisonCheckMock = $this->createMock(SandboxIdDocumentComparisonCheck::class);
        $this->idDocumentComparisonCheckMock
            ->method('jsonSerialize')
            ->willReturn((object) [ 'type' => 'documentComparisonCheck' ]);

        $this->thirdPartyIdentityCheckMock = $this->createMock(SandboxThirdPartyIdentityCheck::class);
        $this->thirdPartyIdentityCheckMock
            ->method('jsonSerialize')
            ->willReturn((object) [ 'type' => 'thirdPartyIdentityCheck' ]);
    }

    /**
     * @test
     * @covers ::withDocumentAuthenticityCheck
     * @covers ::withIdDocumentComparisonCheck
     * @covers ::withDocumentFaceMatchCheck
     * @covers ::withLivenessCheck
     * @covers ::withAsyncReportDelay
     * @covers ::build
     * @covers \Yoti\Sandbox\DocScan\Request\SandboxCheckReports::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\SandboxCheckReports::jsonSerialize
     */
    public function shouldBuildCorrectly()
    {
        $result = (new SandboxCheckReportsBuilder())
            ->withDocumentAuthenticityCheck($this->documentAuthenticityCheckMock)
            ->withIdDocumentComparisonCheck($this->idDocumentComparisonCheckMock)
            ->withLivenessCheck($this->livenessCheckMock)
            ->withDocumentFaceMatchCheck($this->documentFaceMatchCheckMock)
            ->withAsyncReportDelay(self::SOME_ASYNC_REPORT_DELAY)
            ->withThirdPartyIdentityCheck($this->thirdPartyIdentityCheckMock)
            ->build();

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'ID_DOCUMENT_AUTHENTICITY' => [$this->documentAuthenticityCheckMock],
                'ID_DOCUMENT_COMPARISON' => [$this->idDocumentComparisonCheckMock],
                'ID_DOCUMENT_FACE_MATCH' => [$this->documentFaceMatchCheckMock],
                'LIVENESS' => [$this->livenessCheckMock],
                'THIRD_PARTY_IDENTITY' => $this->thirdPartyIdentityCheckMock,
                'async_report_delay' => self::SOME_ASYNC_REPORT_DELAY
            ]),
            json_encode($result)
        );
    }

    /**
     * @test
     * @covers \Yoti\Sandbox\DocScan\Request\SandboxCheckReports::__construct
     * @covers \Yoti\Sandbox\DocScan\Request\SandboxCheckReports::jsonSerialize
     */
    public function shouldConstructWithoutOptionalArguments()
    {
        $checkReports = new SandboxCheckReports(
            [$this->documentAuthenticityCheckMock],
            [$this->documentFaceMatchCheckMock],
            [$this->livenessCheckMock],
            self::SOME_ASYNC_REPORT_DELAY
        );

        $this->assertJsonStringEqualsJsonString(
            json_encode([
                'ID_DOCUMENT_AUTHENTICITY' => [$this->documentAuthenticityCheckMock],
                'ID_DOCUMENT_FACE_MATCH' => [$this->documentFaceMatchCheckMock],
                'LIVENESS' => [$this->livenessCheckMock],
                'async_report_delay' => self::SOME_ASYNC_REPORT_DELAY,
            ]),
            json_encode($checkReports)
        );
    }
}
