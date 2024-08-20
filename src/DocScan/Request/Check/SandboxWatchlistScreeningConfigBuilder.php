<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\SandboxConstants;
use Yoti\Util\Validation;

class SandboxWatchlistScreeningConfigBuilder
{
    /**
     * @var string[]
     */
    private $categories = [];

    /**
     * @return $this
     */
    public function withAdverseMediaCategory(): SandboxWatchlistScreeningConfigBuilder
    {
        return $this->withCategory(SandboxConstants::ADVERSE_MEDIA);
    }

    /**
     * @return $this|SandboxWatchlistScreeningConfigBuilder
     */
    public function withSanctionsCategory(): SandboxWatchlistScreeningConfigBuilder
    {
        return $this->withCategory(SandboxConstants::SANCTIONS);
    }

    /**
     * @param string $category
     * @return $this
     */
    public function withCategory(string $category): SandboxWatchlistScreeningConfigBuilder
    {
        Validation::notEmptyString($category, 'category');
        $this->categories[] = $category;
        $this->categories = array_unique($this->categories);

        return $this;
    }

    /**
     * @return SandboxWatchlistScreeningConfig
     */
    public function build(): SandboxWatchlistScreeningConfig
    {
        return new SandboxWatchlistScreeningConfig($this->categories);
    }
}
