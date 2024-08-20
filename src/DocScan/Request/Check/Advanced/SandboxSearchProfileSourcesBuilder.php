<?php

declare(strict_types=1);

namespace Yoti\Sandbox\DocScan\Request\Check\Advanced;

class SandboxSearchProfileSourcesBuilder
{
    /**
     * @var string
     */
    private $searchProfile;

    /**
     * @param string $searchProfile
     * @return $this
     */
    public function withSearchProfile(string $searchProfile): SandboxSearchProfileSourcesBuilder
    {
        $this->searchProfile = $searchProfile;

        return $this;
    }

    /**
     * @return SandboxSearchProfileSources
     */
    public function build(): SandboxSearchProfileSources
    {
        return new SandboxSearchProfileSources($this->searchProfile);
    }
}
