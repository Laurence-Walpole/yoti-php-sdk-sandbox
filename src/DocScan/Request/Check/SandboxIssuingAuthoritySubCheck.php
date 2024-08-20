<?php

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Filters\SandboxDocumentFilter;

class SandboxIssuingAuthoritySubCheck
{
    /**
     * @var bool|null
     */
    private $requested;

    /**
     * Returns the {@link SandboxDocumentFilter} that will drive which
     * documents the sub check is performed on
     *
     * @var SandboxDocumentFilter|null
     */
    private $filter;

    /**
     * @param bool|null $requested
     * @param SandboxDocumentFilter|null $documentFilter
     */
    public function __construct(?bool $requested, ?SandboxDocumentFilter $documentFilter)
    {
        $this->requested = $requested;
        $this->filter = $documentFilter;
    }

    /**
     * Returns if the issuing authority sub check has been requested
     *
     * @return bool|null
     */
    public function isRequested(): ?bool
    {
        return $this->requested;
    }

    /**
     * @return SandboxDocumentFilter|null
     */
    public function getFilter(): ?SandboxDocumentFilter
    {
        return $this->filter;
    }
}
