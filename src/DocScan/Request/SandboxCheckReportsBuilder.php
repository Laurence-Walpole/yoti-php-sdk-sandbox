<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request;

use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentAuthenticityCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxDocumentFaceMatchCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxIdDocumentComparisonCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxLivenessCheck;
use Yoti\Sandbox\DocScan\Request\Check\SandboxThirdPartyIdentityCheck;

class SandboxCheckReportsBuilder
{
    /**
     * @var SandboxDocumentAuthenticityCheck[]
     */
    private $documentAuthenticityChecks = [];

    /**
     * @var SandboxIdDocumentComparisonCheck[]
     */
    private $idDocumentComparisonChecks = [];

    /**
     * @var SandboxDocumentFaceMatchCheck[]
     */
    private $documentFaceMatchChecks = [];

    /**
     * @var SandboxLivenessCheck[]
     */
    private $livenessChecks = [];

    /**
     * @var SandboxThirdPartyIdentityCheck
     */
    private $thirdPartyIdentityCheck;

    /**
     * @var int
     */
    private $asyncReportDelay;

    /**
     * @param SandboxDocumentAuthenticityCheck $documentAuthenticityCheck
     * @return $this
     */
    public function withDocumentAuthenticityCheck(SandboxDocumentAuthenticityCheck $documentAuthenticityCheck): self
    {
        $this->documentAuthenticityChecks[] = $documentAuthenticityCheck;
        return $this;
    }

    /**
     * @param SandboxLivenessCheck $livenessCheck
     * @return $this
     */
    public function withLivenessCheck(SandboxLivenessCheck $livenessCheck): self
    {
        $this->livenessChecks[] = $livenessCheck;
        return $this;
    }

    /**
     * @param SandboxDocumentFaceMatchCheck $documentFaceMatchCheck
     * @return $this
     */
    public function withDocumentFaceMatchCheck(SandboxDocumentFaceMatchCheck $documentFaceMatchCheck): self
    {
        $this->documentFaceMatchChecks[] = $documentFaceMatchCheck;
        return $this;
    }

    /**
     * @param SandboxIdDocumentComparisonCheck $documentComparisonCheck
     * @return $this
     */
    public function withIdDocumentComparisonCheck(SandboxIdDocumentComparisonCheck $documentComparisonCheck): self
    {
        $this->idDocumentComparisonChecks[] = $documentComparisonCheck;
        return $this;
    }

    /**
     * @param SandboxThirdPartyIdentityCheck $thirdPartyIdentityCheck
     * @return $this
     */
    public function withThirdPartyIdentityCheck(SandboxThirdPartyIdentityCheck $thirdPartyIdentityCheck): self
    {
        $this->thirdPartyIdentityCheck = $thirdPartyIdentityCheck;
        return $this;
    }

    /**
     * @param int $asyncReportDelay
     * @return $this
     */
    public function withAsyncReportDelay(int $asyncReportDelay): self
    {
        $this->asyncReportDelay = $asyncReportDelay;
        return $this;
    }

    /**
     * @return SandboxCheckReports
     */
    public function build(): SandboxCheckReports
    {
        return new SandboxCheckReports(
            $this->documentAuthenticityChecks,
            $this->documentFaceMatchChecks,
            $this->livenessChecks,
            $this->asyncReportDelay,
            $this->idDocumentComparisonChecks,
            $this->thirdPartyIdentityCheck
        );
    }
}
