<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check\Contracts;

use Yoti\Sandbox\DocScan\Request\Check\Contracts\Advanced\SandboxCaMatchingStrategy;
use Yoti\Sandbox\DocScan\Request\Check\Contracts\Advanced\SandboxCaSources;

abstract class SandboxWatchlistAdvancedCaConfigBuilder
{
    /**
     * @var bool
     */
    protected $removeDeceased;

    /**
     * @var bool
     */
    protected $shareUrl;

    /**
     * @var SandboxCaSources
     */
    protected $sources;

    /**
     * @var SandboxCaMatchingStrategy
     */
    protected $matchingStrategy;

    /**
     * @return mixed
     */
    abstract public function build();

    /**
     * @param bool $removeDeceased
     * @return $this
     */
    public function withRemoveDeceased(bool $removeDeceased): SandboxWatchlistAdvancedCaConfigBuilder
    {
        $this->removeDeceased = $removeDeceased;

        return $this;
    }

    /**
     * @param bool $shareUrl
     * @return $this
     */
    public function withShareUrl(bool $shareUrl): SandboxWatchlistAdvancedCaConfigBuilder
    {
        $this->shareUrl = $shareUrl;

        return $this;
    }

    /**
     * @param SandboxCaSources $sources
     * @return $this
     */
    public function withSources(SandboxCaSources $sources): SandboxWatchlistAdvancedCaConfigBuilder
    {
        $this->sources = $sources;

        return $this;
    }

    /**
     * @param SandboxCaMatchingStrategy $matchingStrategy
     * @return $this
     */
    public function withMatchingStrategy(
        SandboxCaMatchingStrategy $matchingStrategy
    ): SandboxWatchlistAdvancedCaConfigBuilder {
        $this->matchingStrategy = $matchingStrategy;

        return $this;
    }
}
