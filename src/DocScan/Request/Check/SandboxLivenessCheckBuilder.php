<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\SandboxConstants;
use Yoti\Util\Validation;

class SandboxLivenessCheckBuilder
{
    private const ZOOM = 'ZOOM';
    private const STATIC = 'STATIC';

    /**
     * @var string
     */
    private $livenessType;

    /**
     * @var int
     */
    private $maxRetries = 1;

    /**
     * @var string|null
     */
    private $manualCheck = null;

    public function forZoomLiveness(): self
    {
        return $this->forLivenessType(self::ZOOM);
    }

    public function forStaticLiveness(): self
    {
        return $this->forLivenessType(self::STATIC);
    }

    public function forLivenessType(string $livenessType): self
    {
        $this->livenessType = $livenessType;
        return $this;
    }

    public function withMaxRetries(int $maxRetries): self
    {
        $this->maxRetries = $maxRetries;
        return $this;
    }

    public function withoutManualCheck(): self
    {
        return $this->withManualCheck(SandboxConstants::NEVER);
    }

    private function withManualCheck(string $manualCheck): self
    {
        $this->manualCheck = $manualCheck;
        return $this;
    }

    public function build(): SandboxLivenessCheck
    {
        Validation::notEmptyString($this->livenessType, 'livenessType');
        Validation::notNull($this->maxRetries, 'maxRetries');

        $config = new SandboxLivenessConfig($this->livenessType, $this->maxRetries, $this->manualCheck);
        return new SandboxLivenessCheck($config);
    }
}
