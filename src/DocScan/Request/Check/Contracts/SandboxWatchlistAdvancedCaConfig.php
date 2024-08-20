<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check\Contracts;

use stdClass;
use Yoti\Sandbox\DocScan\Request\Check\Contracts\Advanced\SandboxCaMatchingStrategy;
use Yoti\Sandbox\DocScan\Request\Check\Contracts\Advanced\SandboxCaSources;
use Yoti\Sandbox\DocScan\Request\Check\SandboxCheckConfigInterface;

abstract class SandboxWatchlistAdvancedCaConfig implements SandboxCheckConfigInterface
{
    /**
     * @var bool
     */
    private $removeDeceased;

    /**
     * @var bool
     */
    private $shareUrl;

    /**
     * @var SandboxCaSources
     */
    private $sources;

    /**
     * @var SandboxCaMatchingStrategy
     */
    private $matchingStrategy;

    /**
     * @return string
     */
    abstract public function getType(): string;

    /**
     * @param bool $removeDeceased
     * @param bool $shareUrl
     * @param SandboxCaSources $sources
     * @param SandboxCaMatchingStrategy $matchingStrategy
     */
    public function __construct(
        bool $removeDeceased,
        bool $shareUrl,
        SandboxCaSources $sources,
        SandboxCaMatchingStrategy $matchingStrategy
    ) {
        $this->removeDeceased = $removeDeceased;
        $this->shareUrl = $shareUrl;
        $this->sources = $sources;
        $this->matchingStrategy = $matchingStrategy;
    }

    /**
     * @return bool
     */
    public function getRemoveDeceased(): bool
    {
        return $this->removeDeceased;
    }

    /**
     * @return bool
     */
    public function getShareUrl(): bool
    {
        return $this->shareUrl;
    }

    /**
     * @return SandboxCaSources
     */
    public function getSources(): SandboxCaSources
    {
        return $this->sources;
    }

    /**
     * @return SandboxCaMatchingStrategy
     */
    public function getMatchingStrategy(): SandboxCaMatchingStrategy
    {
        return $this->matchingStrategy;
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object)[
            'remove_deceased' => $this->getRemoveDeceased(),
            'share_url' => $this->getShareUrl(),
            'sources' => $this->getSources(),
            'matching_strategy' => $this->getMatchingStrategy(),
            'type' => $this->getType(),
        ];
    }
}
