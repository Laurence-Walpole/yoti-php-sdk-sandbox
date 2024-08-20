<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\DocScan\Constants;

class SandboxLivenessCheck extends SandboxCheck
{
    /**
     * @var SandboxLivenessConfig
     */
    private $config;

    /**
     * SandboxLivenessCheck constructor.
     * @param SandboxLivenessConfig $config
     */
    public function __construct(SandboxLivenessConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @inheritDoc
     */
    protected function getType(): string
    {
        return Constants::LIVENESS;
    }

    /**
     * @inheritDoc
     */
    protected function getConfig(): ?SandboxCheckConfigInterface
    {
        return $this->config;
    }
}
