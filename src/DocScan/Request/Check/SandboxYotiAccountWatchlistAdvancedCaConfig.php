<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfig;
use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxYotiAccountWatchlistAdvancedCaConfig extends SandboxWatchlistAdvancedCaConfig
{
    /**
     * @return string
     */
    public function getType(): string
    {
        return SandboxConstants::WITH_YOTI_ACCOUNT;
    }
}
