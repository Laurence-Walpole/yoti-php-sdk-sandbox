<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request;

use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck;
use Yoti\Util\Json;

class SandboxCheckReports implements \JsonSerializable
{
    /**
     * @var SandboxDocumentAuthenticityCheck[]
     */
    private $documentAuthenticityChecks;

    /**
     * @var SandboxIdDocumentComparisonCheck[]|null
     */
    private $idDocumentComparisonChecks;

    /**
     * @var SandboxDocumentFaceMatchCheck[]
     */
    private $documentFaceMatchChecks;

    /**
     * @var SandboxThirdPartyIdentityCheck|null
     */
    private $thirdPartyIdentityCheck;

    /**
     * @var SandboxLivenessCheck[]
     */
    private $livenessChecks;

    /**
     * @var int|null
     */
    private $asyncReportDelay;

    /**
     * SandboxCheckReport constructor.
     *
     * @param SandboxDocumentAuthenticityCheck[] $documentAuthenticityChecks
     * @param SandboxDocumentFaceMatchCheck[] $documentFaceMatchChecks
     * @param SandboxLivenessCheck[] $livenessChecks
     * @param int|null $asyncReportDelay
     * @param SandboxIdDocumentComparisonCheck[]|null $idDocumentComparisonChecks
     * @param SandboxThirdPartyIdentityCheck|null $thirdPartyIdentityCheck
     */
    public function __construct(
        array $documentAuthenticityChecks,
        array $documentFaceMatchChecks,
        array $livenessChecks,
        ?int $asyncReportDelay,
        ?array $idDocumentComparisonChecks = null,
        SandboxThirdPartyIdentityCheck $thirdPartyIdentityCheck = null
    ) {
        $this->documentAuthenticityChecks = $documentAuthenticityChecks;
        $this->documentFaceMatchChecks = $documentFaceMatchChecks;
        $this->livenessChecks = $livenessChecks;
        $this->asyncReportDelay = $asyncReportDelay;
        $this->idDocumentComparisonChecks = $idDocumentComparisonChecks;
        $this->thirdPartyIdentityCheck = $thirdPartyIdentityCheck;
    }

    /**
     * @return \stdClass
     */
    public function jsonSerialize(): \stdClass
    {
        return (object) Json::withoutNullValues([
            'ID_DOCUMENT_AUTHENTICITY' => $this->documentAuthenticityChecks,
            'ID_DOCUMENT_FACE_MATCH' => $this->documentFaceMatchChecks,
            'ID_DOCUMENT_COMPARISON' => $this->idDocumentComparisonChecks,
            'LIVENESS' => $this->livenessChecks,
            'THIRD_PARTY_IDENTITY' => $this->thirdPartyIdentityCheck,
            'async_report_delay' => $this->asyncReportDelay,
        ]);
    }
}
