<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check\Contracts\Advanced;

use stdClass;
use Yoti\Util\Json;

abstract class SandboxCaSources implements \JsonSerializable
{
    /**
     * @var string
     */
    public $type;

    /**
     * @return string
     */
    abstract public function getType(): string;

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object)Json::withoutNullValues([
            'type' => $this->getType(),
        ]);
    }
}
