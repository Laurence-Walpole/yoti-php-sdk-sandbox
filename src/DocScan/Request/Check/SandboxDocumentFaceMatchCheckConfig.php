<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use stdClass;
use Yoti\DocScan\Session\Create\Check\RequestedCheckConfigInterface;

class SandboxFaceMatchCheckConfig implements RequestedCheckConfigInterface
{
    /**
     * @var string
     */
    private $manualCheck;

    public function __construct(string $manualCheck)
    {
        $this->manualCheck = $manualCheck;
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object) [
            'manual_check' => $this->getManualCheck(),
        ];
    }

    /**
     * @return string
     */
    public function getManualCheck(): string
    {
        return $this->manualCheck;
    }
}
