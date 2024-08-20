<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use stdClass;
use Yoti\Util\Json;

class SandboxDocumentAuthenticityCheckConfig implements SandboxCheckConfigInterface
{
    /**
     * @var string|null
     */
    private $manualCheck;

    /**
     * @var SandboxIssuingAuthoritySubCheck|null
     */
    private $issuingAuthoritySubCheck;

    /**
     * @param string|null $manualCheck
     * @param SandboxIssuingAuthoritySubCheck|null $issuingAuthoritySubCheck
     */
    public function __construct(?string $manualCheck, ?SandboxIssuingAuthoritySubCheck $issuingAuthoritySubCheck = null)
    {
        $this->manualCheck = $manualCheck;
        $this->issuingAuthoritySubCheck = $issuingAuthoritySubCheck;
    }

    /**
     * @return stdClass
     */
    public function jsonSerialize(): stdClass
    {
        return (object) Json::withoutNullValues([
            'manual_check' => $this->getManualCheck(),
            'issuing_authority_sub_check' => $this->getIssuingAuthoritySubCheck(),
        ]);
    }

    /**
     * @return string|null
     */
    public function getManualCheck(): ?string
    {
        return $this->manualCheck;
    }

    /**
     * @return SandboxIssuingAuthoritySubCheck|null
     */
    public function getIssuingAuthoritySubCheck(): ?SandboxIssuingAuthoritySubCheck
    {
        return $this->issuingAuthoritySubCheck;
    }
}
