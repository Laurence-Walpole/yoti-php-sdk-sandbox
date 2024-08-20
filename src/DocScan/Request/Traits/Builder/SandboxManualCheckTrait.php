<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Traits\Builder;

use Yoti\Sandbox\DocScan\SandboxConstants;

trait SandboxManualCheckTrait
{
    /**
     * @var string
     */
    private $manualCheck;

    /**
     * @param string $manualCheck
     *
     * @return $this
     */
    private function setManualCheck(string $manualCheck): self
    {
        $this->manualCheck = $manualCheck;
        return $this;
    }

    /**
     * @return $this
     */
    public function withManualCheckAlways(): self
    {
        return $this->setManualCheck(SandboxConstants::ALWAYS);
    }

    /**
     * @return $this
     */
    public function withManualCheckFallback(): self
    {
        return $this->setManualCheck(SandboxConstants::FALLBACK);
    }

    /**
     * @return $this
     */
    public function withManualCheckNever(): self
    {
        return $this->setManualCheck(SandboxConstants::NEVER);
    }
}
