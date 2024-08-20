<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxDocumentAuthenticityCheck extends SandboxCheck
{
    /**
     * @var SandboxDocumentAuthenticityCheckConfig|null
     */
    private $config;

    public function __construct(?SandboxDocumentAuthenticityCheckConfig $config = null)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return SandboxConstants::ID_DOCUMENT_AUTHENTICITY;
    }

    /**
     * @inheritDoc
     */
    public function getConfig(): ?SandboxCheckConfigInterface
    {
        return $this->config;
    }
}
