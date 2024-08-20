<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use JsonSerializable;
use stdClass;
use Yoti\Util\Json;

abstract class SandboxCheck implements JsonSerializable
{
    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object) Json::withoutNullValues([
            'type' => $this->getType(),
            'config' => $this->getConfig()
        ]);
    }

    /**
     * @return string
     */
    abstract protected function getType(): string;

    /**
     * @return SandboxCheckConfigInterface|null
     */
    abstract protected function getConfig(): ?SandboxCheckConfigInterface;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return Json::encode($this);
    }
}
