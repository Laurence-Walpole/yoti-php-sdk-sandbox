<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfig;

class SandboxWatchlistAdvancedCaCheckBuilder
{
    /**
     * @var SandboxWatchlistAdvancedCaConfig
     */
    private $config;

    /**
     * @param SandboxWatchlistAdvancedCaConfig $config
     * @return $this
     */
    public function withConfig(SandboxWatchlistAdvancedCaConfig $config): SandboxWatchlistAdvancedCaCheckBuilder
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return SandboxWatchlistAdvancedCaCheck
     */
    public function build(): SandboxWatchlistAdvancedCaCheck
    {
        return new SandboxWatchlistAdvancedCaCheck($this->config);
    }
}
