<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

class SandboxWatchlistScreeningCheckBuilder
{
    /**
     * @var SandboxWatchlistScreeningConfig|null
     */
    private $config;

    /**
     * @param SandboxWatchlistScreeningConfig|null $config
     * @return SandboxWatchlistScreeningCheckBuilder
     */
    public function withConfig(?SandboxWatchlistScreeningConfig $config): SandboxWatchlistScreeningCheckBuilder
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return SandboxWatchlistScreeningCheck
     */
    public function build(): SandboxWatchlistScreeningCheck
    {
        return new SandboxWatchlistScreeningCheck($this->config);
    }
}
