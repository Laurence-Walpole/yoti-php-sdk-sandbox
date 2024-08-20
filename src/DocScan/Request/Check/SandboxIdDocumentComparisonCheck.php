<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxIdDocumentComparisonCheck extends SandboxCheck
{
    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return SandboxConstants::ID_DOCUMENT_COMPARISON;
    }

    /**
     * @inheritDoc
     */
    protected function getConfig(): ?SandboxCheckConfigInterface
    {
        return null;
    }
}
