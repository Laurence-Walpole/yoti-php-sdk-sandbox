<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

class SandboxIdDocumentComparisonCheckBuilder extends SandboxCheckBuilder
{
    public function build(): SandboxIdDocumentComparisonCheck
    {
        return new SandboxIdDocumentComparisonCheck();
    }
}
