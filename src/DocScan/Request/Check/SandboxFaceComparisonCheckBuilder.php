<?php

namespace Yoti\Sandbox\DocScan\Request\Check;

use Yoti\Sandbox\DocScan\Request\Traits\Builder\SandboxManualCheckTrait;
use Yoti\Util\Validation;

class SandboxFaceComparisonCheckBuilder
{
    use SandboxManualCheckTrait;

    public function build(): SandboxFaceComparisonCheck
    {
        Validation::notEmptyString($this->manualCheck, 'manualCheck');

        $config = new SandboxFaceComparisonCheckConfig($this->manualCheck);
        return new SandboxFaceComparisonCheck($config);
    }
}
