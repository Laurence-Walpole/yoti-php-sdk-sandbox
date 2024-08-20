<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\DocScan\Constants;

class SandboxThirdPartyIdentityCheck extends SandboxCheck
{
    /**
     * @return string
     */
    protected function getType(): string
    {
        return Constants::THIRD_PARTY_IDENTITY;
    }

    /**
     * @return SandboxCheckConfigInterface|null
     */
    protected function getConfig(): ?SandboxCheckConfigInterface
    {
        return null;
    }
}
