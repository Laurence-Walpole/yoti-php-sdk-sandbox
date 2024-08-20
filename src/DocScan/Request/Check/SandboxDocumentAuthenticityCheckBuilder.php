<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Filters\SandboxDocumentFilter;
use Yoti\Sandbox\DocScan\Request\Traits\Builder\SandboxManualCheckTrait;

class SandboxDocumentAuthenticityCheckBuilder
{
    use SandboxManualCheckTrait;

    /**
     * @var SandboxIssuingAuthoritySubCheck|null
     */
    private $issuingAuthoritySubCheck;

    /**
     * @return $this
     */
    public function withIssuingAuthoritySubCheck(): SandboxDocumentAuthenticityCheckBuilder
    {
        $this->issuingAuthoritySubCheck = (new SandboxIssuingAuthoritySubCheckBuilder())
            ->withRequested(true)
            ->build();

        return $this;
    }

    /**
     * @param SandboxDocumentFilter $filter
     * @return $this
     */
    public function withIssuingAuthoritySubCheckAndDocumentFilter(
        SandboxDocumentFilter $filter
    ): SandboxDocumentAuthenticityCheckBuilder {
        $this->issuingAuthoritySubCheck = (new SandboxIssuingAuthoritySubCheckBuilder())
            ->withRequested(true)
            ->withDocumentFilter($filter)
            ->build();

        return $this;
    }

    /**
     * @return SandboxDocumentAuthenticityCheck
     */
    public function build(): SandboxDocumentAuthenticityCheck
    {
        $config = new SandboxDocumentAuthenticityCheckConfig($this->manualCheck, $this->issuingAuthoritySubCheck);
        return new SandboxDocumentAuthenticityCheck($config);
    }
}
