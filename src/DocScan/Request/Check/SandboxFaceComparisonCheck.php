<?php

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\SandboxConstants;

class SandboxFaceComparisonCheck extends SandboxCheck
{
    /**
     * @var SandboxFaceComparisonCheckConfig
     */
    private $config;

    public function __construct(SandboxFaceComparisonCheckConfig $config)
    {
        $this->config = $config;
    }

    protected function getType(): string
    {
        return SandboxConstants::FACE_COMPARISON;
    }

    protected function getConfig(): ?SandboxCheckConfigInterface
    {
        return $this->config;
    }
}
