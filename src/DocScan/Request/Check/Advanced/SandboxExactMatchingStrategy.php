<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check\Advanced;

use Yoti\Sandbox\DocScan\Request\Check\Contracts\Advanced\SandboxCaMatchingStrategy;
use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxExactMatchingStrategy extends SandboxCaMatchingStrategy
{
    /**
     * @return bool
     */
    public function isExactMatch(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return SandboxConstants::EXACT;
    }
}
