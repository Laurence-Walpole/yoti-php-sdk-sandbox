<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfigBuilder;

class SandboxYotiAccountWatchlistAdvancedCaConfigBuilder extends SandboxWatchlistAdvancedCaConfigBuilder
{
    /**
     * @return SandboxYotiAccountWatchlistAdvancedCaConfig
     */
    public function build(): SandboxYotiAccountWatchlistAdvancedCaConfig
    {
        return new SandboxYotiAccountWatchlistAdvancedCaConfig(
            $this->removeDeceased,
            $this->shareUrl,
            $this->sources,
            $this->matchingStrategy
        );
    }
}
