<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Traits\Builder\SandboxManualCheckTrait;
use Yoti\Util\Validation;

class SandboxDocumentFaceMatchCheckBuilder
{
    use SandboxManualCheckTrait;

    public function build(): SandboxDocumentFaceMatchCheck
    {
        Validation::notEmptyString($this->manualCheck, 'manualCheck');

        $config = new SandboxDocumentFaceMatchCheckConfig($this->manualCheck);
        return new SandboxDocumentFaceMatchCheck($config);
    }
}
