<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Check\Contracts\SandboxWatchlistAdvancedCaConfig;
use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxWatchlistAdvancedCaCheck extends SandboxCheck
{
    /**
     * @var SandboxWatchlistAdvancedCaConfig
     */
    private $config;

    public function __construct(SandboxWatchlistAdvancedCaConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return SandboxConstants::WATCHLIST_ADVANCED_CA;
    }

    /**
     * @return SandboxCheckConfigInterface|null
     */
    public function getConfig(): ?SandboxCheckConfigInterface
    {
        return $this->config;
    }
}
