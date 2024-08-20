<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check\Advanced;

use Yoti\DocScan\Session\Create\Check\Advanced\RequestedExactMatchingStrategy;

class SandboxExactMatchingStrategyBuilder
{
    /**
     * @return RequestedExactMatchingStrategy
     */
    public function build(): RequestedExactMatchingStrategy
    {
        return new RequestedExactMatchingStrategy();
    }
}
