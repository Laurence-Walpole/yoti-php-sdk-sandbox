<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxWatchlistScreeningCheck extends SandboxCheck
{
    /**
     * @var SandboxWatchlistScreeningConfig|null
     */
    private $config;

    /**
     * RequestedWatchlistScreeningCheck constructor.
     * @param SandboxWatchlistScreeningConfig|null $config
     */
    public function __construct(?SandboxWatchlistScreeningConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return SandboxConstants::WATCHLIST_SCREENING;
    }

    /**
     * @return SandboxCheckConfigInterface|null
     */
    public function getConfig(): ?SandboxCheckConfigInterface
    {
        return $this->config;
    }
}
