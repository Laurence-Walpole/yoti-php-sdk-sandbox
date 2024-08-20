<?php

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Filters\SandboxDocumentFilter;

class SandboxIssuingAuthoritySubCheckBuilder
{
    /**
     * @var bool
     */
    private $requested;

    /**
     * Returns the {@link SandboxDocumentFilter} that will drive which
     * documents the sub check is performed on
     *
     * @var SandboxDocumentFilter
     */
    private $filter;

    /**
     * @param bool $requested
     * @return $this
     */
    public function withRequested(bool $requested): SandboxIssuingAuthoritySubCheckBuilder
    {
        $this->requested = $requested;

        return $this;
    }

    /**
     * @param SandboxDocumentFilter $filter
     * @return $this
     */
    public function withDocumentFilter(SandboxDocumentFilter $filter): SandboxIssuingAuthoritySubCheckBuilder
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * @return SandboxIssuingAuthoritySubCheck
     */
    public function build(): SandboxIssuingAuthoritySubCheck
    {
        return new SandboxIssuingAuthoritySubCheck($this->requested, $this->filter);
    }
}
