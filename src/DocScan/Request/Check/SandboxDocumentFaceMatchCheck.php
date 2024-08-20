<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxDocumentFaceMatchCheck extends SandboxCheck
{
    /**
     * @var SandboxDocumentFaceMatchCheckConfig
     */
    private $config;

    public function __construct(SandboxDocumentFaceMatchCheckConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return SandboxConstants::ID_DOCUMENT_FACE_MATCH;
    }

    /**
     * @inheritDoc
     */
    protected function getConfig(): ?SandboxCheckConfigInterface
    {
        return $this->config;
    }
}
