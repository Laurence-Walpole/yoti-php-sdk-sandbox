<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

class SandboxThirdPartyIdentityCheckBuilder
{
    public function build(): SandboxThirdPartyIdentityCheck
    {
        return new SandboxThirdPartyIdentityCheck();
    }
}
